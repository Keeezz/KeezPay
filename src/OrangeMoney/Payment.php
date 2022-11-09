<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney;

use KeezPay\Shared\Entity\PaymentInterface;
use Symfony\Component\Uid\Ulid;

final class Payment implements PaymentInterface
{
    private Ulid $id;

    private string $merchantName;

    private string $merchantKey;

    private string $currency;

    private string $orderId;

    private string $amount;

    private string $returnUrl;

    private string $cancelUrl;

    private string $notifyUrl;

    private string $language;

    private ?\DateTimeInterface $createdAt;

    public static function create(
    Ulid $id,
    string $merchantName,
    string $merchantKey,
    string $currency,
    string $orderId,
    string $amount,
    string $returnUrl,
    string $cancelUrl,
    string $notifyUrl,
    string $language,
    ?\DateTimeInterface $createdAt = null
  ): self {
        $payment = new self();
        $payment->id = $id;
        $payment->merchantName = $merchantName;
        $payment->merchantKey = $merchantKey;
        $payment->currency = $currency;
        $payment->orderId = $orderId;
        $payment->amount = $amount;
        $payment->returnUrl = $returnUrl;
        $payment->cancelUrl = $cancelUrl;
        $payment->notifyUrl = $notifyUrl;
        $payment->language = $language;
        $payment->createdAt = $createdAt;

        return $payment;
    }

    public function id(): Ulid
    {
        return $this->id;
    }

    public function merchantName(): string
    {
        return $this->merchantName;
    }

    public function merchantKey(): string
    {
        return $this->merchantKey;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function orderId(): string
    {
        return $this->orderId;
    }

    public function amount(): string
    {
        return $this->amount;
    }

    public function returnUrl(): string
    {
        return $this->returnUrl;
    }

    public function cancelUrl(): string
    {
        return $this->cancelUrl;
    }

    public function notifyUrl(): string
    {
        return $this->notifyUrl;
    }

    public function language(): string
    {
        return $this->language;
    }

    public function createdAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
}
