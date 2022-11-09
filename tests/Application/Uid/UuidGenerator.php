<?php

declare(strict_types=1);

namespace KeezPay\Tests\Application\Uid;

use KeezPay\Shared\Uid\UuidGeneratorInterface;
use Symfony\Component\Uid\Uuid;

final class UuidGenerator implements UuidGeneratorInterface
{
    public function generate(): Uuid
    {
        return Uuid::v4();
    }
}
