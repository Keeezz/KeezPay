<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\MakePaymentIntent;

use KeezPay\Shared\Command\Command;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class PaymentIntent implements Command
{
    #[NotBlank]
    public string $merchantKey;

    #[NotBlank]
    public string $currency;

    #[Length(min: 1, max: 30)]
    #[NotBlank]
    public string $orderId;

    #[NotBlank]
    public string $amount;

    #[Length(min: 1, max: 120)]
    #[NotBlank]
    public string $returnUrl;

    #[Length(min: 1, max: 120)]
    #[NotBlank]
    public string $cancelUrl;

    #[Length(min: 1, max: 120)]
    #[NotBlank]
    public string $notifyUrl;

    #[NotBlank]
    public string $language;

    #[Length(min: 1, max: 30)]
    #[NotBlank]
    public string $merchantName;
}
