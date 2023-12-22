<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use Closure;
use Laventure\Component\Container\Concrete\BoundConcrete;
use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;
use Laventure\Component\Container\Concrete\SharedConcrete;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Facade\Facade;
use Laventure\Component\Container\Provider\ServiceProvider;
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
 * Container
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container
*/
class Container implements ContainerInterface, \ArrayAccess
{
    /**
     * @var static
    */
    protected static $instance;



    /**
     * @var BoundConcrete[]
    */
    protected array $bindings = [];



    /**
     * @var array
    */
    protected array $aliases = [];




    /**
     * @var array
    */
    protected array $instances = [];



    /**
     * @var SharedConcrete[]
    */
    protected array $shared  = [];




    /**
     * @var array
    */
    protected array $resolved = [];




    /**
     * @var ServiceProvider[]
    */
    protected array $providers = [];




    /**
     * @var array
    */
    protected array $provides = [];




    /**
     * @var Facade[]
    */
    protected array $facades = [];





    /**
     * @param ContainerInterface|null $instance
     *
     * @return ContainerInterface|null
    */
    public static function setInstance(ContainerInterface $instance = null): ?ContainerInterface
    {
        return static::$instance = $instance;
    }




    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (!static::$instance) {
            static::$instance = new self();
        }

        return self::$instance;
    }




    /**
     * @param ConcreteInterface $concrete
     *
     * @return $this
    */
    public function bindConcrete(ConcreteInterface $concrete): static
    {
        $this->bindings[$concrete->getId()] = $concrete;

        return $this;
    }




    /**
     * @param string $id
     *
     * @param mixed $concrete
     *
     * @return $this
    */
    public function bind(string $id, mixed $concrete): static
    {
        return $this->bindConcrete(new BoundConcrete($id, $concrete));
    }




    /**
     * @param string $id
     *
     * @param string $alias
     *
     * @return $this
    */
    public function alias(string $id, string $alias): static
    {
        $this->aliases[$alias] = $id;

        return $this;
    }




    /**
     * @param string $id
     *
     * @return string
    */
    public function getAlias(string $id): string
    {
        return $this->aliases[$id] ?? $id;
    }




    /**
     * @param string $id
     *
     * @param array $aliases
     *
     * @return $this
    */
    public function aliases(string $id, array $aliases): self
    {
        foreach ($aliases as $alias) {
            $this->alias($id, $alias);
        }

        return $this;
    }





    /**
     * @param string $id
     *
     * @return bool
    */
    public function bound(string $id): bool
    {
        return isset($this->bindings[$id]);
    }






    /**
     * @param string $id
     *
     * @param mixed $concrete
     *
     * @return $this
    */
    public function singleton(string $id, mixed $concrete): static
    {
        $this->shared[$id] = new SharedConcrete($id, $concrete);

        return $this->bindConcrete($this->shared[$id]);
    }





    /**
     * @param string $id
     *
     * @param object $instance
     *
     * @return $this
    */
    public function instance(string $id, object $instance): static
    {
        $this->instances[$id] = $instance;

        return $this;
    }





    /**
     * @param string $id
     *
     * @param array $with
     *
     * @return mixed
    */
    public function make(string $id, array $with = []): mixed
    {
        return $this->resolve($id, $with);
    }




    /**
     * @param string $id
     *
     * @return mixed
    */
    public function factory(string $id): mixed
    {
        return $this->make($id);
    }




    /**
     * @param string $id
     *
     * @return bool
    */
    public function hasInstance(string $id): bool
    {
        return isset($this->instances[$id]);
    }




    /**
     * @param string $id
     *
     * @return bool
    */
    public function shared(string $id): bool
    {
        return isset($this->shared[$id]);
    }





    /**
     * @param string $id
     *
     * @return bool
    */
    public function sharable(string $id): bool
    {
        return ($this->shared($id) || $this->hasInstance($id));
    }



    /**
     * @param string $id
     *
     * @param mixed $value
     *
     * @return mixed
    */
    public function share(string $id, mixed $value): mixed
    {
        if (!$this->hasInstance($id)) {
            $this->instances[$id] = $value;
        }

        return $this->instances[$id];
    }


    /**
     * @inheritDoc
     * @throws ReflectionException
     */
    public function get(string $id): mixed
    {
        $id = $this->getAlias($id);

        if ($this->has($id)) {

            $concrete = $this->getConcrete($id);
            $value    = $this->getConcreteValue($concrete);

            if ($this->shared($id)) {
                return $this->share($id, $value);
            }

            return $value;
        }

        return $this->resolve($id);
    }




    /**
     * @inheritDoc
    */
    public function has(string $id): bool
    {
        return ($this->bound($id) || $this->hasInstance($id));
    }






    /**
     * @param string $id
     *
     * @return bool
    */
    public function resolved(string $id): bool
    {
        return isset($this->resolved[$id]);
    }






    /**
     * @param string $id
     *
     * @param array $with
     *
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function resolve(string $id, array $with = []): mixed
    {
        if (!class_exists($id)) {
            return $id;
        }


        // 1. Inspect the class that we are trying to get from the container
        $reflection = new ReflectionClass($id);

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
     * @param Closure $func
     *
     * @param array $with
     *
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function callAnonymous(Closure $func, array $with = []): mixed
    {
        $with = $this->resolveDependencies(new ReflectionFunction($func), $with);

        return call_user_func_array($func, $with);
    }







    /**
     * @throws ContainerException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
    */
    public function call(string $class, string $method, array $with = []): mixed
    {
        $object = $this->get($class);

        $method = new ReflectionMethod($class, $method);

        $with = $this->resolveDependencies($method, $with);

        return call_user_func_array([$object, $method->name], $with);
    }


    /**
     * @param ReflectionFunctionAbstract $func
     *
     * @param array $with
     *
     * @return array
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    private function resolveDependencies(ReflectionFunctionAbstract $func, array $with = []): array
    {
        return array_map(function (ReflectionParameter $parameter) use ($with) {
            return $this->resolveDependency($parameter, $with);

        }, $func->getParameters());
    }


    /**
     * @param ReflectionParameter $parameter
     *
     * @param array $with
     *
     * @return mixed
     *
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
     */
    private function resolveDependency(ReflectionParameter $parameter, array $with = []): mixed
    {
        $name = $parameter->getName();
        $type = $parameter->getType();

        if ($parameter->isOptional()) {
            return $parameter->getDefaultValue();
        }

        if (!$type) {
            throw new ContainerException(
                'Failed to resolve parameter because param "'. $name . '" is missing a type hint.'
            );
        }

        if ($type instanceof ReflectionUnionType) {
            throw new ContainerException(
                'Failed to resolve parameter because of union type for param "'. $name . '"'
            );
        }

        if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
            return $this->get($type->getName());
        }

        if (array_key_exists($name, $with)) {
            return $with[$name];
        }

        throw new ContainerException('Failed to resolve because invalid param "'. $name . '"');
    }



    /**
     * Returns all entries
     *
     * @return array
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }





    /**
     * Returns instances
     *
     * @return array
     */
    public function getInstances(): array
    {
        return $this->instances;
    }




    /**
     * @param string $id
     *
     * @return void
     */
    public function remove(string $id): void
    {
        if ($this->has($id)) {
            unset($this->bindings[$id]);
        }
    }




    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }





    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }



    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->bind($offset, $value);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }





    /**
     * @param $name
     * @return array|bool|mixed|object|string|null
    */
    public function __get($name)
    {
        return $this[$name];
    }




    /**
     * @param $name
     * @param $value
    */
    public function __set($name, $value)
    {
        $this[$name] = $value;
    }



    public function clear(): void
    {
        $this->bindings  = [];
        $this->instances = [];
        $this->aliases   = [];
        $this->resolved  = [];
    }






    /**
     * @param string $id
     *
     * @return BoundConcrete
    */
    private function getConcrete(string $id): BoundConcrete
    {
        return $this->bindings[$id];
    }




    /**
     * @param BoundConcrete $concrete
     *
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
    */
    private function getConcreteValue(BoundConcrete $concrete): mixed
    {
        $value = $concrete->getValue();

        if ($concrete->callable()) {
            $value = $this->callAnonymous($value, [$this]);
        }

        if (is_string($value) && class_exists($value)) {
            $value = $this->resolve($value);
        }

        return $value;
    }




    /**
     * @param $id
     *
     * @return bool
    */
    private function resolvable($id): bool
    {
        return (is_string($id) && class_exists($id));
    }
}
