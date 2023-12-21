<?php
declare(strict_types=1);

namespace Laventure\Component\Container;

use Closure;
use Laventure\Component\Container\Concrete\BoundConcrete;
use Laventure\Component\Container\Concrete\Contract\ConcreteInterface;
use Laventure\Component\Container\Concrete\InstanceConcrete;
use Laventure\Component\Container\Concrete\SharedConcrete;
use Laventure\Component\Container\Resolver\Contract\ResolverInterface;
use Laventure\Component\Container\Resolver\Resolver;
use Psr\Container\ContainerInterface;


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
     * @var BoundConcrete[]
    */
    protected array $bindings = [];


    /**
     * @var array
    */
    protected array $instances = [];




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
     * @param $concrete
     *
     * @return $this
    */
    public function bind(string $id, $concrete): static
    {
        return $this->bindConcrete(new BoundConcrete($id, $concrete));
    }




    /**
     * @param string $id
     *
     * @param $concrete
     *
     * @return $this
    */
    public function singleton(string $id, $concrete): static
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
         if (! isset($this->instances[$id])) {
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
    */
    public function get(string $id): mixed
    {
         if ($this->has($id)) {

             $concrete = $this->getConcrete($id);
             $value    = $concrete->getValue();

             if ($concrete->callable()) {
                 $value = $this->callAnonymous($value);
             }

             if ($concrete instanceof SharedConcrete) {
                 return $this->share($id, $value);
             }

             return $value;
         }

         return $this->resolve($id);
    }




    /**
     * @param Closure $func
     *
     * @param array $parameters
     *
     * @return mixed
    */
    public function callAnonymous(Closure $func, array $parameters = []): mixed
    {
         return $this->getResolver()->resolveAnonymous($func, $parameters);
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
    */
    public function resolve(string $id): mixed
    {
        return $this->getResolver()->resolve($id);
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

    }
}