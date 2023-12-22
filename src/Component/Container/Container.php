<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use Closure;
use Laventure\Component\Container\Common\ContainerAwareInterface;
use Laventure\Component\Container\Concrete\BoundConcrete;
use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;
use Laventure\Component\Container\Concrete\SharedConcrete;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Facade\Facade;
use Laventure\Component\Container\Provider\Contract\BootableServiceProvider;
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
     * @var array
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
     * @param mixed $value
     *
     * @return $this
    */
    public function bind(string $id, mixed $value): static
    {
        return $this->bindConcrete(new BoundConcrete($id, $value));
    }



    /**
     * @param array $bindings
     *
     * @return $this
    */
    public function binds(array $bindings): static
    {
        foreach ($bindings as $id => $value) {
            $this->bind($id, $value);
        }

        return $this;
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
     * @param mixed $value
     *
     * @return $this
    */
    public function singleton(string $id, mixed $value): static
    {
        return $this->bindConcrete(new SharedConcrete($id, $value));
    }





    /**
     * @param array $bindings
     * @return $this
    */
    public function singletons(array $bindings): static
    {
        foreach ($bindings as $id => $value) {
             $this->singleton($id, $value);
        }

        return $this;
    }





    /**
     * @param string $id
     *
     * @param object|string $instance
     *
     * @return $this
     *
     * @throws ContainerException
     *
     * @throws ContainerExceptionInterface
     *
     * @throws NotFoundExceptionInterface
     *
     * @throws ReflectionException
    */
    public function instance(string $id, object|string $instance): static
    {
        if (is_string($instance)) {
            $instance = $this->factory($instance);
        }

        $this->instances[$id] = $instance;

        return $this;
    }





    /**
     * @param string $id
     *
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function factory(string $id): mixed
    {
        return $this->make($id);
    }


    /**
     * @param array $factories
     * @return array
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function factories(array $factories): array
    {
        return array_map(function (string $id) {
            return $this->factory($id);
        }, $factories);
    }







    /**
     * @param string $provider
     *
     * @return bool
    */
    public function hasProvider(string $provider): bool
    {
        return isset($this->providers[$provider]);
    }





    /**
     * @param string $provider
     * @return $this
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function addProvider(string $provider): static
    {
        if (!$this->hasProvider($provider)) {
            $service = $this->makeProvider($provider);
            $this->addProvides($provider, $service->getProvides());
            $service->setContainer($this);
            $this->bootProvider($service);
            $service->register();
            $this->providers[$provider] = $service;
        }

        return $this;
    }






    /**
     * @param array $providers
     *
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function addProviders(array $providers): static
    {
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }

        return $this;
    }





    /**
     * @param string $facade
     * @return bool
    */
    public function hasFacade(string $facade): bool
    {
        return isset($this->facades[$facade]);
    }




    /**
     * @param string $facade
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function addFacade(string $facade): static
    {
        if (!$this->hasFacade($facade)) {
            $this->facades[$facade] = $this->makeFacade($facade);
        }

        return $this;
    }




    /**
     * @param array $facades
     *
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function addFacades(array $facades): static
    {
        foreach ($facades as $facade) {
            $this->addFacade($facade);
        }

        return $this;
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
     * @param mixed $value
     *
     * @return mixed
    */
    public function share(string $id, mixed $value): mixed
    {
        if (!$this->shared($id)) {
            $this->shared[$id] = $value;
        }

        return $this->shared[$id];
    }





    /**
     * @inheritDoc
     * @throws ReflectionException
     */
    public function get(string $id): mixed
    {
        $id = $this->getAlias($id);

        if ($this->has($id)) {

            $concrete = $this->bindings[$id];
            $value    = $this->resolveConcrete($concrete);

            if ($concrete instanceof SharedConcrete) {
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
        return $this->bound($id);
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
        if ($this->resolved($id)) {
            return $this->resolved[$id];
        }

        if ($this->hasInstance($id)) {
            $instance = $this->instances[$id];
        } else {
            $instance = $this->make($id, $with);
        }

        return $this->resolved[$id] = $instance;
    }





    /**
     * @param string $id
     *
     * @param array $with
     *
     * @return mixed
     * @throws ContainerException
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function make(string $id, array $with = []): mixed
    {
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
     * @param string $provider
     * @return ServiceProvider
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function makeProvider(string $provider): ServiceProvider
    {
        return $this->make($provider);
    }





    /**
     * @param string $facade
     * @return Facade
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    public function makeFacade(string $facade): Facade
    {
        return $this->make($facade);
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
        $object = $this->make($class);
        $method = new ReflectionMethod($class, $method);

        if ($object instanceof ContainerAwareInterface) {
            $object->setContainer($this);
        }

        $with = $this->resolveDependencies($method, $with);

        return call_user_func_array([$object, $method->name], $with);
    }






    /**
     * @param string $id
     *
     * @return void
     */
    public function remove(string $id): void
    {
        unset(
            $this->bindings[$id],
            $this->instances[$id],
            $this->resolved[$id]
        );
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
     * @return array
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }


    /**
     * @return array
     */
    public function getFacades(): array
    {
        return $this->facades;
    }



    /**
     * @return array
    */
    public function getProviders(): array
    {
        return $this->providers;
    }


    /**
     * @return array
    */
    public function getProvides(): array
    {
        return $this->provides;
    }


    /**
     * @return array
    */
    public function getResolved(): array
    {
        return $this->resolved;
    }



    /**
     * @return array
    */
    public function getShared(): array
    {
        return $this->shared;
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

        if (array_key_exists($name, $with)) {
            return $with[$name];
        }

        if ($parameter->isOptional()) {
            return $parameter->getDefaultValue();
        }

        if (!$type) {
            throw new ContainerException('Failed to resolve parameter "'. $name . '" is missing a type hint.');
        }

        if ($type instanceof ReflectionUnionType) {
            throw new ContainerException('Failed to resolve parameter because of union type for param "'. $name . '"');
        }

        if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
            return $this->get($type->getName());
        }

        throw new ContainerException('Failed to resolve because invalid param "'. $name . '"');
    }





    /**
     * @param BoundConcrete $concrete
     *
     * @return mixed
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
    */
    private function resolveConcrete(BoundConcrete $concrete): mixed
    {
        $value = $concrete->getValue();

        if ($concrete->resolvable()) {
            return $this->resolve($value);
        }

        if ($concrete->callable()) {
            $value = $this->callAnonymous($value);
        }

        return $value;
    }





    /**
     * @param string $service
     *
     * @param array $provides
     *
     * @return void
     */
    private function addProvides(string $service, array $provides): void
    {
        foreach ($provides as $id => $aliases) {
            $this->alias($id, $aliases);
        }

        $this->provides[$service] = $provides;
    }



    /**
     * @param ServiceProvider $provider
     *
     * @return void
    */
    protected function bootProvider(ServiceProvider $provider): void
    {
        if($provider instanceof BootableServiceProvider) {
            $provider->boot();
        }
    }
}
