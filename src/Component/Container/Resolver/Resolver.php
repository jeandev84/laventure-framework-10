<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Resolver;

use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Reflection\Func\FunctionReflected;
use Laventure\Component\Container\Reflection\Func\MethodReflected;
use Laventure\Component\Container\Resolver\Contract\ResolverInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

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
    public function resolve(string $id, array $with = []): mixed
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflection = $this->inspectorClass($id);

        if (!$reflection->isInstantiable()) {
            throw new ContainerException('Class "'. $id . '" is not instantiable');
        }

        // 2. Inspect the constructor of the class
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return $reflection->newInstance();
        }

        // 3. Inspect the constructor parameters (dependencies)
        if (!$constructor->getParameters()) {
            return $reflection->newInstance();
        }

        $dependencies = $this->resolveDependencies($constructor, $with);

        return $reflection->newInstanceArgs($dependencies);
    }



    /**
     * @param ReflectionFunctionAbstract $func
     *
     * @param array $with
     *
     * @return array
     *
     * @throws ContainerExceptionInterface
    */
    public function resolveDependencies(ReflectionFunctionAbstract $func, array $with = []): array
    {
        return array_map(function (ReflectionParameter $parameter) use ($with) {

            $name = $parameter->getName();
            $type = $parameter->getType();

            if (!$type) {
                throw new ContainerException('Failed to resolve parameter because param "'. $name . '" is missing a type hint.');
            }

            if ($type instanceof ReflectionUnionType) {
                throw new ContainerException('Failed to resolve parameter because of union type for param "'. $name . '"');
            }

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                return $this->container->get($type->getName());
            }

            if (array_key_exists($name, $with)) {
                return $with[$name];
            }

            throw new ContainerException('Failed to resolve because invalid param "'. $name . '"');

        }, $func->getParameters());
    }




    /**
     * @param callable $func
     * @param array $with
     * @return mixed
     *
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
    */
    public function resolveAnonymous(callable $func, array $with = []): mixed
    {
        $dependencies = $this->resolveDependencies(new ReflectionFunction($func), $with);

        return call_user_func_array($func, $dependencies);
    }





    /**
     * @param $id
     *
     * @return bool
    */
    public function resolvable($id): bool
    {
        return (is_string($id) && class_exists($id));
    }




    /**
     * @throws ReflectionException
    */
    private function inspectorClass(string $id): ReflectionClass
    {
        return new ReflectionClass($id);
    }
}
