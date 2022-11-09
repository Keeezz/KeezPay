<?php

declare(strict_types=1);

namespace KeezPay\Tests\OrangeMoney;

use KeezPay\OrangeMoney\MakePaymentIntent\NewPayment;
use KeezPay\OrangeMoney\MakePaymentIntent\PaymentIntent;
use KeezPay\OrangeMoney\Payment;
use KeezPay\OrangeMoney\PaymentGateway;
use KeezPay\Tests\CommandTestCase;
use Symfony\Component\Messenger\Exception\ValidationFailedException;

final class MakePaymentIntentTest extends CommandTestCase
{
    public function testShouldInitAPayment(): void
    {
        $this->commandBus->execute(self::createPaymentIntent());

        /** @var PaymentGateway $paymentGateway */
        $paymentGateway = $this->container->get(PaymentGateway::class);
        $payment = $paymentGateway->getPaymentByOrderId('123456789');

        self::assertInstanceOf(Payment::class, $payment);
        self::assertSame('123456789', $payment->orderId());
        self::assertSame('10000', $payment->amount());
        self::assertSame('XOF', $payment->currency());
        self::assertSame('https://keezpay.com/return', $payment->returnUrl());
        self::assertSame('https://keezpay.com/cancel', $payment->cancelUrl());
        self::assertSame('https://keezpay.com/notify', $payment->notifyUrl());
        self::assertSame('fr', $payment->language());
        self::assertSame('keezpay', $payment->merchantName());
        self::assertSame('keezpay', $payment->merchantKey());
        self::assertTrue($this->eventDispatcher->hasDispatched(NewPayment::class));
    }

    /**
     * @dataProvider provideInvalidPaymentIntents
     */
    public function testShouldFailedDueToInvalidPaymentIntentData(PaymentIntent $paymentIntent): void
    {
        self::expectException(ValidationFailedException::class);
        $this->commandBus->execute($paymentIntent);
    }

    public function provideInvalidPaymentIntents(): \Generator
    {
        yield 'invalid order id' => [self::createPaymentIntent(orderId: '123456789123456789123456789123456789')];
    }

    private static function createPaymentIntent(
    string $merchantKey = 'keezpay',
    string $currency = 'XOF',
    string $orderId = '123456789',
    string $amount = '10000',
    string $returnUrl = 'https://keezpay.com/return',
    string $cancelUrl = 'https://keezpay.com/cancel',
    string $notifyUrl = 'https://keezpay.com/notify',
    string $language = 'fr',
    string $merchantName = 'keezpay',
  ): PaymentIntent {
        $paymentIntent = new PaymentIntent();
        $paymentIntent->merchantKey = $merchantKey;
        $paymentIntent->currency = $currency;
        $paymentIntent->orderId = $orderId;
        $paymentIntent->amount = $amount;
        $paymentIntent->returnUrl = $returnUrl;
        $paymentIntent->cancelUrl = $cancelUrl;
        $paymentIntent->notifyUrl = $notifyUrl;
        $paymentIntent->language = $language;
        $paymentIntent->merchantName = $merchantName;

        return $paymentIntent;
    }
}
