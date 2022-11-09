<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney;

use KeezPay\Shared\Gateway;

interface PaymentGateway extends Gateway
{
    public function init(Payment $payment): void;

    public function getPaymentByOrderId(string $orderId): ?Payment;
}
