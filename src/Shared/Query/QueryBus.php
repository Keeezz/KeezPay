<?php

declare(strict_types=1);

namespace KeezPay\Shared\Query;

interface QueryBus
{
    public function fetch(Query $query): mixed;
}
