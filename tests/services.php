<?php

declare(strict_types=1);

use KeezPay\OrangeMoney\AccessTokenGateway;
use KeezPay\OrangeMoney\MakePaymentIntent\MakePaymentIntent;
use KeezPay\OrangeMoney\MakePaymentIntent\PaymentIntent;
use KeezPay\OrangeMoney\PaymentGateway;
use KeezPay\OrangeMoney\RequestAccessToken\AccessTokenRequest;
use KeezPay\OrangeMoney\RequestAccessToken\RequestAccessToken;
use KeezPay\Shared\Command\CommandBus;
use KeezPay\Shared\EventDispatcher\EventDispatcher;
use KeezPay\Shared\Query\QueryBus;
use KeezPay\Shared\Uid\UlidGeneratorInterface;
use KeezPay\Shared\Uid\UuidGeneratorInterface;
use KeezPay\Tests\Application\Container\Container;
use KeezPay\Tests\Application\CQRS\TestCommandBus;
use KeezPay\Tests\Application\CQRS\TestQueryBus;
use KeezPay\Tests\Application\EventDispatcher\TestEventDispatcher;
use KeezPay\Tests\Application\Repository\InMemoryAccessTokenRepository;
use KeezPay\Tests\Application\Repository\InMemoryPaymentRepository;
use KeezPay\Tests\Application\Uid\UlidGenerator;
use KeezPay\Tests\Application\Uid\UuidGenerator;

return function (Container $container): void {
    $container
      ->set(
          RequestAccessToken::class,
          static fn (Container $container) => new RequestAccessToken(
              $container->get(AccessTokenGateway::class)
          )
      )
      ->set(
          MakePaymentIntent::class,
          static fn (Container $container) => new MakePaymentIntent(
              $container->get(PaymentGateway::class),
              $container->get(EventDispatcher::class),
              $container->get(UlidGeneratorInterface::class),
          )
      )
      ->set(
          PaymentGateway::class,
          static fn (Container $container): PaymentGateway => new InMemoryPaymentRepository()
      )
      ->set(
          AccessTokenGateway::class,
          static fn (Container $container): AccessTokenGateway => new InMemoryAccessTokenRepository()
      )
      ->set(
          UuidGeneratorInterface::class,
          static fn (Container $container): UuidGeneratorInterface => new UuidGenerator()
      )
      ->set(
          UlidGeneratorInterface::class,
          static fn (Container $container): UlidGeneratorInterface => new UlidGenerator()
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
            PaymentIntent::class => MakePaymentIntent::class,
          ])
      );
};
