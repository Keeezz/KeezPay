<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney;

final class AccessToken
{
    private string $tokenType;

    private string $value;

    private int $expiresIn;

    public static function create(
    string $tokenType,
    string $value,
    int $espireIn,
  ): self {
        $accessToken = new self();
        $accessToken->tokenType = $tokenType;
        $accessToken->value = $value;
        $accessToken->expiresIn = $espireIn;

        return $accessToken;
    }

    public function tokenType(): string
    {
        return $this->tokenType;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function expiresIn(): int
    {
        return $this->expiresIn;
    }
}
