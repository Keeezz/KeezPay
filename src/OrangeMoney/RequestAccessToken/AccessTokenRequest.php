<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\RequestAccessToken;

use KeezPay\Shared\Query\Query;
use Symfony\Component\Validator\Constraints\NotBlank;

final class AccessTokenRequest implements Query
{
    public function __construct(
    #[NotBlank]
    public string $customerKey,
  ) {
    }
}
