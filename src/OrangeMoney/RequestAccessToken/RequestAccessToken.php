<?php

declare(strict_types=1);

namespace KeezPay\OrangeMoney\RequestAccessToken;

use KeezPay\Shared\Query\QueryHandler;
use KeezPay\OrangeMoney\AccessTokenGateway;
use KeezPay\Shared\EventDispatcher\EventDispatcher;

final class RequestAccessToken implements QueryHandler
{
  public function __construct(
    private AccessTokenGateway $accessTokenGateway,
    private EventDispatcher $eventDispatcher
  ) {
  }

  public function __invoke(AccessTokenRequest $accessTokenRequest)
  {
    $accessToken = $this->accessTokenGateway->requestAccessToken($accessTokenRequest->customerKey);

    if (null === $accessToken) {
      throw new NoAccessTokenFoundException();
    }

    $this->eventDispatcher->dispatch(new AccessTokenRequested($accessToken));

    return $accessToken;
  }
}
