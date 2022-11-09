<?php

declare(strict_types=1);

namespace KeezPay\Shared\Command;

interface CommandBus
{
  public function execute(Command $command): void;
}
