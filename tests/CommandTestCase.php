<?php

declare(strict_types=1);

namespace KeezPay\Tests;

use KeezPay\Shared\Command\CommandBus;
use KeezPay\Tests\Application\Container\Container;
use KeezPay\Shared\EventDispatcher\EventDispatcher;
use KeezPay\Tests\Application\EventDispatcher\TestEventDispatcher;

abstract class CommandTestCase extends ContainerTestCase
{
  protected CommandBus $commandBus;

  protected TestEventDispatcher $eventDispatcher;

  protected Container $container;

  public function setUp(): void
  {
    $this->container = self::createContainer();
    $this->commandBus = $this->container->get(CommandBus::class);
    $this->eventDispatcher = $this->container->get(EventDispatcher::class);
  }

  protected function tearDown(): void
  {
    $this->eventDispatcher->reset();
  }
}
