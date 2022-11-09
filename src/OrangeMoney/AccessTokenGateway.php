<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney;

use KeezPay\Shared\Gateway;

interface AccessTokenGateway extends Gateway
{
    public function requestAccessToken(string $customerKey): ?AccessToken;
}
