<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\RequestAccessToken;

use KeezPay\OrangeMoney\AccessToken;
use KeezPay\Shared\EventDispatcher\Event;

final class AccessTokenRequested implements Event
{
  public function __construct(private AccessToken $accessToken)
  {
  }
}
