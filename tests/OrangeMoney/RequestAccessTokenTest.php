<?php

declare(strict_types=1);

namespace KeezPay\Tests\OrangeMoney;

use KeezPay\Tests\QueryTestCase;
use KeezPay\OrangeMoney\AccessToken;
use KeezPay\OrangeMoney\RequestAccessToken\AccessTokenRequest;

final class RequestAccessTokenTest extends QueryTestCase
{
  public function testShouldReturnAnAccessToken(): void
  {
    /** @var ?AccessToken $accessToken */
    $accessToken = $this->queryBus->fetch(new AccessTokenRequest('6ed2fcb0-e83c-4856-b33d-632e1433e542'));

    self::assertInstanceOf(AccessToken::class, $accessToken);
    self::assertSame('6ed2fcb0-e83c-4866-b33d-632e1433e542', $accessToken->value());
  }
}
