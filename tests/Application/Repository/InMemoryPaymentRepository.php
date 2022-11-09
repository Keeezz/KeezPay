<?php

declare(strict_types=1);

namespace KeezPay\Tests\Application\Repository;

use KeezPay\OrangeMoney\Payment;
use KeezPay\OrangeMoney\PaymentGateway;
use Symfony\Component\Uid\Ulid;

final class InMemoryPaymentRepository implements PaymentGateway
{
    /**
     * @var array<string, Payment>
     */
    private array $payments = [];

    public function __construct()
    {
        $this->initialize();
    }

    public static function createPayment(int $index, string $ulid): Payment
    {
        return Payment::create(
            id: Ulid::fromString($ulid),
            merchantName: sprintf('merchant-%d', $index),
            merchantKey: sprintf('merchant-key-%d', $index),
            currency: 'XOF',
            orderId: sprintf('order-id-%d', $index),
            amount: '10000',
            returnUrl: 'https://keezpay.com/return',
            cancelUrl: 'https://keezpay.com/cancel',
            notifyUrl: 'https://keezpay.com/notify',
            language: 'fr',
        );
    }

    public function initialize(): void
    {
        $this->payments = [
          '01GHEKA99MQVRY5M0W3XA2CQ89' => self::createPayment(1, '01GHEKA99MQVRY5M0W3XA2CQ89'),
          '01GHEKBJFYKAVCS67PQ5CGK1KX' => self::createPayment(2, '01GHEKBJFYKAVCS67PQ5CGK1KX'),
          '01GHEKC12EKW21GS477CW7FJMB' => self::createPayment(3, '01GHEKC12EKW21GS477CW7FJMB'),
          '01GHEKC2ZJZQZJZQZJZQZJZQZJ' => self::createPayment(4, '01GHEKC2ZJZQZJZQZJZQZJZQZJ'),
          '01GHEKCP36T47V0NVSN85A4846' => self::createPayment(5, '01GHEKCP36T47V0NVSN85A4846'),
        ];
    }

    public function init(Payment $payment): void
    {
        $this->payments[(string) $payment->id()] = $payment;
    }

    public function getPaymentByOrderId(string $orderId): ?Payment
    {
        foreach ($this->payments as $payment) {
            if ($payment->orderId() === $orderId) {
                return $payment;
            }
        }

        return null;
    }
}
