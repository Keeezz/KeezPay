<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\MakePaymentIntent;

use KeezPay\OrangeMoney\Payment;
use KeezPay\Shared\EventDispatcher\Event;

final class NewPayment implements Event
{
    public function __construct(public Payment $payment)
    {
    }
}
