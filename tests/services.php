<?php

declare(strict_types=1);

use KeezPay\OrangeMoney\AccessTokenGateway;
use KeezPay\OrangeMoney\RequestAccessToken\AccessTokenRequest;
use KeezPay\OrangeMoney\RequestAccessToken\RequestAccessToken;
use KeezPay\Shared\Command\CommandBus;
use KeezPay\Shared\EventDispatcher\EventDispatcher;
use KeezPay\Shared\Query\QueryBus;
use KeezPay\Tests\Application\Container\Container;
use KeezPay\Tests\Application\CQRS\TestCommandBus;
use KeezPay\Tests\Application\CQRS\TestQueryBus;
use KeezPay\Tests\Application\EventDispatcher\TestEventDispatcher;
use KeezPay\Tests\Application\Repository\InMemoryAccessTokenRepository;

return function (Container $container): void {
    $container
      ->set(
          RequestAccessToken::class,
          static fn (Container $container) => new RequestAccessToken(
              $container->get(AccessTokenGateway::class),
              $container->get(EventDispatcher::class)
          )
      )
      ->set(
          AccessTokenGateway::class,
          static fn (Container $container): AccessTokenGateway => new InMemoryAccessTokenRepository()
      )
      ->set(
          EventDispatcher::class,
          static fn (Container $container): EventDispatcher => new TestEventDispatcher($container, [
            // ...
          ])
      )
      ->set(
          QueryBus::class,
          static fn (Container $container): QueryBus => new TestQueryBus($container, [
            AccessTokenRequest::class => RequestAccessToken::class,
          ])
      )
      ->set(
          CommandBus::class,
          static fn (Container $container): CommandBus => new TestCommandBus($container, [
            // Add your command handlers here
          ])
      );
};
