<?php
declare(strict_types=1);

namespace Laventure\Component\Container\Resolver;


use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;
use Laventure\Component\Container\Resolver\Contract\ResolverInterface;
use Psr\Container\ContainerInterface;

/**
 * Resolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Resolver
 */
class Resolver implements ResolverInterface
{

    /**
     * @var ContainerInterface
    */
    protected ContainerInterface $container;



    /**
     * @param ContainerInterface $container
    */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }




    /**
     * @inheritDoc
    */
    public function getContainer(): ContainerInterface
    {
         return $this->container;
    }




    /**
     * @inheritDoc
    */
    public function resolve(mixed $value, array $parameters = []): mixed
    {
         if (is_callable($value)) {
             return $this->callAnonymous($value);
         }

         return $value;
    }



    /**
     * @param callable $func
     * @param array $parameters
     * @return mixed
    */
    public function callAnonymous(callable $func, array $parameters = []): mixed
    {
        return call_user_func($func);
    }
}