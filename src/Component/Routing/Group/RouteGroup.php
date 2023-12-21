<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Group;

use Laventure\Component\Routing\Group\Invoker\RouteGroupInvokerInterface;

/**
 * RouteGroup
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Group
*/
class RouteGroup implements RouteGroupInterface
{

    /**
     * @var string 
    */
    protected string $namespace;
    
    
    /**
     * @var array
    */
    protected array $path = [];

    /**
     * @var array
    */
    protected array $namespaces = [];
    
    /**
     * @var array
    */
    protected array $name = [];

    /**
     * @var array
    */
    protected array $middlewares = [];


    
    
    /**
     * @param string $namespace
    */
    public function __construct(string $namespace = '')
    {
        $this->namespace($namespace);
    }




    /**
     * @param string $namespace
     *
     * @return $this
    */
    public function namespace(string $namespace): static
    {
        $this->namespaces[] = trim($namespace, '\\');

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return join("\\", $this->namespaces);
    }





    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->path[] = trim($path, '/');

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return join('/', $this->path);
    }




    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
        $this->name[] = $name;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return join($this->name);
    }





    /**
     * @param array|string $middlewares
     *
     * @return $this
    */
    public function middlewares(array|string $middlewares): static
    {
         if (is_string($middlewares)) {
             $middlewares = (array) $middlewares;
         }

         $this->middlewares = array_merge($this->middlewares, $middlewares);

         return $this;
    }



    

    /**
     * @inheritDoc
    */
    public function group(RouteGroupInvokerInterface $invoker): mixed
    {
         $attributes = $invoker->getAttributes();

         $this->path($attributes->path)
              ->namespace($attributes->namespace)
              ->name($attributes->name)
              ->middlewares($attributes->middlewares);


         $invoker->invoke();

         $this->clear();
         
         return $this;
    }

    
    
    
    /**
     * @inheritDoc
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }




    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        
    }




    /**
     * Resolve route path
     *
     * @param string $path
     *
     * @return string
     */
    public function resolvePath(string $path): string
    {

    }





    /**
     * Resolve the correct path of mapped route
     *
     * @param string $name
     *
     * @return string
    */
    public function resolveName(string $name): string
    {

    }



    /**
     * @param mixed $action
     *
     * @return mixed
     */
    public function resolveAction(mixed $action): mixed
    {

    }
}
