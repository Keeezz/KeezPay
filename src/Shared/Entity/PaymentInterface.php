<?php

declare(strict_types=1);

namespace KeezPay\Shared\Entity;

use Symfony\Component\Uid\Ulid;

interface PaymentInterface
{
    public function id(): Ulid;
}
