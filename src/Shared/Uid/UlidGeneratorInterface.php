<?php

declare(strict_types=1);

namespace KeezPay\Shared\Uid;

use Symfony\Component\Uid\Ulid;

interface UlidGeneratorInterface
{
    public function generate(): Ulid;
}
