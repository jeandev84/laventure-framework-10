<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

use Closure;
use Laventure\Component\Container\Concrete\BoundConcrete;
use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;
use Laventure\Component\Container\Concrete\InstanceConcrete;
use Laventure\Component\Container\Concrete\SharedConcrete;
use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Resolver\Contract\ResolverInterface;
use Laventure\Component\Container\Resolver\Resolver;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use ReflectionException;

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
    protected array $instances = [];



    /**
     * @var array
    */
    protected array $resolved  = [];




    /**
     * Get container instance <Singleton>
     *
     * @return static
    */
    public static function getInstance(): static
    {
        if(is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
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
     * @param mixed $concrete
     *
     * @return $this
    */
    public function singleton(string $id, mixed $concrete): static
    {
        return $this->bindConcrete(new SharedConcrete($id, $concrete));
    }





    /**
     * @param string $id
     *
     * @param $instance
     *
     * @return $this
    */
    public function instance(string $id, $instance): static
    {
        $this->instances[$id] = new InstanceConcrete($id, $instance);

        return $this;
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
        if (!isset($this->instances[$id])) {
            $this->instances[$id] = $value;
        }

        return $this->instances[$id];
    }




    /**
     * @param string $id
     *
     * @return BoundConcrete
    */
    public function getConcrete(string $id): BoundConcrete
    {
        return $this->bindings[$id];
    }


    /**
     * @inheritDoc
     *
     * @throws ReflectionException
    */
    public function get(string $id): mixed
    {
        if ($this->has($id)) {

            $concrete = $this->getConcrete($id);
            $value    = $this->getConcreteValue($concrete);

            if ($concrete instanceof SharedConcrete) {
                return $this->share($id, $value);
            }

            return $value;
        }

        return $this->resolve($id);
    }


    /**
     * @param $id
     *
     * @return bool
    */
    protected function resolvable($id): bool
    {
        return $this->getResolver()->resolvable($id);
    }




    /**
     * @param Closure $func
     *
     * @param array $with
     *
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
     */
    public function callAnonymous(Closure $func, array $with = []): mixed
    {
        return $this->getResolver()->resolveAnonymous($func, $with);
    }





    /**
     * @inheritDoc
    */
    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }





    /**
     * @param string $id
     *
     * @return mixed
     *
     * @throws ContainerException
    */
    public function resolve(string $id): mixed
    {
        if (isset($this->resolved[$id])) {
            return $this->resolved[$id];
        }

        return $this->resolved[$id] = $this->getResolver()->resolve($id);
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
     * @return Resolver
    */
    public function getResolver(): Resolver
    {
        return new Resolver($this);
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
        if ($this->resolvable($value)) {
            $value = $this->resolve($value);
        }

        return  $value;
    }
}
