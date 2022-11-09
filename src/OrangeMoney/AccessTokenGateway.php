<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney;

interface AccessTokenGateway
{
  public function requestAccessToken(string $customerKey): ?AccessToken;
}
