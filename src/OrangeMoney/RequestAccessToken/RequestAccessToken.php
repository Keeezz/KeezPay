<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\RequestAccessToken;

use KeezPay\OrangeMoney\AccessToken;
use KeezPay\OrangeMoney\AccessTokenGateway;
use KeezPay\Shared\Query\QueryHandler;

final class RequestAccessToken implements QueryHandler
{
    public function __construct(
    private AccessTokenGateway $accessTokenGateway
  ) {
    }

    public function __invoke(AccessTokenRequest $accessTokenRequest): AccessToken
    {
        $accessToken = $this->accessTokenGateway->requestAccessToken($accessTokenRequest->customerKey);

        if (null === $accessToken) {
            throw new NoAccessTokenFoundException();
        }

        return $accessToken;
    }
}
