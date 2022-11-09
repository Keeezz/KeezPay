<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\MakePaymentIntent;

use KeezPay\OrangeMoney\Payment;
use KeezPay\OrangeMoney\PaymentGateway;
use KeezPay\Shared\Command\CommandHandler;
use KeezPay\Shared\EventDispatcher\EventDispatcher;
use KeezPay\Shared\Uid\UlidGeneratorInterface;

final class MakePaymentIntent implements CommandHandler
{
    public function __construct(
    private PaymentGateway $paymentGateway,
    private EventDispatcher $eventDispatcher,
    private UlidGeneratorInterface $ulidGenerator,
  ) {
    }

    public function __invoke(PaymentIntent $paymentIntent): void
    {
        $payment = Payment::create(
            id: $this->ulidGenerator->generate(),
            merchantName: $paymentIntent->merchantName,
            merchantKey: $paymentIntent->merchantKey,
            currency: $paymentIntent->currency,
            orderId: $paymentIntent->orderId,
            amount: $paymentIntent->amount,
            returnUrl: $paymentIntent->returnUrl,
            cancelUrl: $paymentIntent->cancelUrl,
            notifyUrl: $paymentIntent->notifyUrl,
            language: $paymentIntent->language
        );

        $this->paymentGateway->init($payment);

        $this->eventDispatcher->dispatch(new NewPayment($payment));
    }
}
