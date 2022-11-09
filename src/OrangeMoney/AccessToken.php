<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney;

final class AccessToken
{
  private string $value;

  public static function create(string $value): self
  {
    $accessToken = new self();
    $accessToken->value = $value;

    return $accessToken;
  }

  public function value(): string
  {
    return $this->value;
  }
}
