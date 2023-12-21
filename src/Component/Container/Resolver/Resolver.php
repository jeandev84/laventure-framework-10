<?php
declare(strict_types=1);

namespace Laventure\Component\Container\Resolver;


use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;
use Laventure\Component\Container\Resolver\Contract\ResolverInterface;
use Psr\Container\ContainerInterface;
use ReflectionFunctionAbstract;

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
    public function resolve(string $id, array $parameters = []): mixed
    {
         $reflection = new \ReflectionClass($id);

         return $id;
    }





    /**
     * @param callable $func
     * @param array $parameters
     * @return mixed
    */
    public function resolveAnonymous(callable $func, array $parameters = []): mixed
    {
        return call_user_func($func);
    }





    /**
     * @param ReflectionFunctionAbstract $method
     *
     * @param array $with
     *
     * @return array
     */
    public function resolveDependencies(ReflectionFunctionAbstract $method, array $with = []): array
    {
         $dependencies = $method->getParameters();

         return array_map(function (\ReflectionParameter $parameter) use ($with) {

             $name = $parameter->getName();
             $type = $parameter->getType();

         }, $dependencies);
    }
}