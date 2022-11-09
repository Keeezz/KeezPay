<?php

declare(strict_types=1);

namespace KeezPay\Tests\Application\Repository;

use KeezPay\OrangeMoney\AccessToken;
use KeezPay\OrangeMoney\AccessTokenGateway;

final class InMemoryAccessTokenRepository implements AccessTokenGateway
{
  private array $accessTokens = [];

  public function __construct()
  {
    $this->init();
  }

  public static function createAccessToken(string $value): AccessToken
  {
    return AccessToken::create($value);
  }

  public function init(): void
  {
    $this->accessTokens = [
      '6ed2fcb0-e83c-4856-b33d-632e1433e542' => self::createAccessToken('6ed2fcb0-e83c-4866-b33d-632e1433e542'),
      '6ed2fcb0-e83c-4866-b33d-632e1433e543' => self::createAccessToken('6ed2fcb0-e83c-4876-b33d-632e1433e543'),
      '6ed2fcb0-e83c-4876-b33d-632e1433e544' => self::createAccessToken('6ed2fcb0-e83c-4886-b33d-632e1433e544'),
      '6ed2fcb0-e83c-4886-b33d-632e1433e545' => self::createAccessToken('6ed2fcb0-e83c-4896-b33d-632e1433e545'),
    ];
  }

  public function requestAccessToken(string $customerKey): ?AccessToken
  {
    return $this->accessTokens[$customerKey] ?? null;
  }
}
