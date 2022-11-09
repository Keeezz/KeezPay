<?php

declare(strict_types=1);

namespace KeezPay\Tests\Application\Uid;

use KeezPay\Shared\Uid\UlidGeneratorInterface;
use Symfony\Component\Uid\Ulid;

final class UlidGenerator implements UlidGeneratorInterface
{
    public function generate(): Ulid
    {
        return new Ulid();
    }
}
