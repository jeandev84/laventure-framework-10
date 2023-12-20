<?php

declare(strict_types=1);

namespace Laventure\Component\Routing;

use Laventure\Component\Routing\Collection\RouteCollection;
use Laventure\Component\Routing\Enums\HttpMethod;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteFactory;

/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing
 */
class Router implements RouterInterface
{
    /**
     * @var RouteCollection
    */
    protected RouteCollection $collection;


    /**
     * @var RouteFactory
    */
    protected RouteFactory $routeFactory;




    public function __construct()
    {
        $this->collection   = new RouteCollection();
        $this->routeFactory = new RouteFactory();
    }



    /**
     * @param Route $route
     *
     * @return Route
    */
    public function add(Route $route): Route
    {
        return $this->collection->addRoute($route);
    }





    /**
     * @param string|array $methods
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
     */
    public function route(string|array $methods, string $path, mixed $action, string $name = null): Route
    {
        return $this->routeFactory->make($methods, $path, $action, $name);
    }






    /**
     * @inheritdoc
    */
    public function map(string|array $methods, string $path, mixed $action, string $name = null): Route
    {
        return $this->add($this->route($methods, $path, $action, $name));
    }





    /**
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function get(string $path, mixed $action, string $name = null): Route
    {
        return $this->map(HttpMethod::GET, $path, $action, $name);
    }






    /**
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function post(string $path, mixed $action, string $name = null): Route
    {
        return $this->map(HttpMethod::POST, $path, $action, $name);
    }




    /**
     * @param string $path
     * @param mixed $action
     * @param string|null $name
     * @return Route
    */
    public function put(string $path, mixed $action, string $name = null): Route
    {
        return $this->map(HttpMethod::PUT, $path, $action, $name);
    }





    /**
     * @param string $path
     * @param mixed $action
     * @param string|null $name
     * @return Route
    */
    public function delete(string $path, mixed $action, string $name = null): Route
    {
        return $this->map(HttpMethod::DELETE, $path, $action, $name);
    }





    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): Route|false
    {
        foreach ($this->getRoutes() as $route) {
            if ($route->match($method, $path)) {
                return $route;
            }
        }

        return false;
    }







    /**
     * @inheritDoc
    */
    public function generate(string $name, array $parameters = []): ?string
    {
        if (!$this->collection->hasRoute($name)) {
            return null;
        }

        return $this->collection->getRoute($name)->generateUri($parameters);
    }






    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        return $this->collection->getRoutes();
    }






    /**
     * @return RouteCollection
    */
    public function getCollection(): RouteCollection
    {
        return $this->collection;
    }
}
