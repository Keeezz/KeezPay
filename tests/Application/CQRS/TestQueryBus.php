<?php

declare(strict_types=1);

namespace KeezPay\Tests\Application\CQRS;

use KeezPay\Shared\Query\Query;
use KeezPay\Shared\Query\QueryBus;
use KeezPay\Shared\Query\QueryHandler;
use Psr\Container\ContainerInterface;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Validator\ContainerConstraintValidatorFactory;
use Symfony\Component\Validator\Validation;

final class TestQueryBus implements QueryBus
{
    /**
     * @param array<class-string<Query>, class-string<QueryHandler>> $handlers
     */
    public function __construct(private ContainerInterface $container, private array $handlers)
    {
    }

    public function fetch(Query $query): mixed
    {
        $constraintValidatorFactory = new ContainerConstraintValidatorFactory($this->container);

        $validator = Validation::createValidatorBuilder()
          ->setConstraintValidatorFactory($constraintValidatorFactory)
          ->enableAnnotationMapping()
          ->getValidator();

        $violations = $validator->validate($query);

        if (count($violations) > 0) {
            throw new ValidationFailedException($query, $violations);
        }

        return $this->container->get($this->handlers[$query::class])->__invoke($query);
    }
}
