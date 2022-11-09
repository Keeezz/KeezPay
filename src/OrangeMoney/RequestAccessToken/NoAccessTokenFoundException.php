<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\RequestAccessToken;

use InvalidArgumentException;

final class NoAccessTokenFoundException extends InvalidArgumentException
{
}
