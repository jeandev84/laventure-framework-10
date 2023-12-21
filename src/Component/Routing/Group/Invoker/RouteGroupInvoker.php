<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Group\Invoker;

use Closure;
use Laventure\Component\Routing\Group\DTO\RouteGroupAttributes;
use Laventure\Component\Routing\RouterInterface;

/**
 * RouteGroupInvoker
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Group\Invoker
 */
class RouteGroupInvoker implements RouteGroupInvokerInterface
{
    /**
     * @param array $attributes
     *
     * @param Closure $routes
     *
     * @param RouterInterface $router
    */
    public function __construct(
        protected array $attributes,
        protected Closure $routes,
        protected RouterInterface $router
    ) {
    }





    /**
     * @inheritdoc
    */
    public function invoke(): mixed
    {
        return call_user_func($this->routes, $this->router);
    }




    /**
     * @inheritDoc
    */
    public function getRoutes(): callable
    {
        return $this->routes;
    }





    /**
     * @inheritDoc
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }



    /**
     * @inheritDoc
    */
    public function getAttributes(): RouteGroupAttributes
    {
        return new RouteGroupAttributes(
       $this->attributes['path'] ?? '',
  $this->attributes['namespace'] ?? '',
      $this->attributes['name'] ?? '',
 $this->attributes['middlewares'] ?? []
        );
    }
}
