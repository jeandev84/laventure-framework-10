<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Collection;

use Laventure\Component\Routing\Route\Route;

/**
 * RouteCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Collection
*/
class RouteCollection
{
    /**
     * @var Route[]
    */
    protected array $routes = [];



    /**
     * @var Route[]
    */
    protected array $methods = [];




    /**
     * @var Route[]
    */
    protected array $controllers = [];





    /**
     * @var Route[]
    */
    protected array $namedRoutes = [];





    /**
     * @param Route $route
     *
     * @return Route
     */
    public function addRoute(Route $route): Route
    {
        $this->addByMethod($route);
        $this->addByController($route);
        $this->addByName($route);

        return $this->routes[] = $route;
    }




    /**
     * @param Route[] $routes
     *
     * @return $this
    */
    public function addRoutes(array $routes): static
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }

        return $this;
    }





    /**
     * @param string $name
     *
     * @return bool
    */
    public function remove(string $name): bool
    {
        if($named = $this->hasRoute($name)) {
            unset($this->namedRoutes[$name]);
        }

        return (!$named);
    }





    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasRoute(string $name): bool
    {
        return array_key_exists($name, $this->namedRoutes);
    }





    /**
     * @param string $name
     *
     * @return Route|null
    */
    public function getRoute(string $name): ?Route
    {
        return $this->namedRoutes[$name] ?? null;
    }




    /**
     * @return Route[]
    */
    public function getMethods(): array
    {
        return $this->methods;
    }





    /**
     * @return Route[]
    */
    public function getControllers(): array
    {
        return $this->controllers;
    }





    /**
     * @return Route[]
     */
    public function getNamedRoutes(): array
    {
        return $this->namedRoutes;
    }





    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }




    public function clear(): void
    {
        $this->methods     = [];
        $this->namedRoutes = [];
        $this->controllers = [];
        $this->routes      = [];
    }






    /**
     * @param Route $route
     *
     * @return void
     */
    private function addByMethod(Route $route): void
    {
        $this->methods[$route->getMethod()][] = $route;
    }




    /**
     * @param Route $route
     *
     * @return void
     */
    private function addByController(Route $route): void
    {
        if ($controller = $route->getController()) {
            $this->controllers[$controller][] = $route;
        }
    }




    /**
     * @param Route $route
     *
     * @return void
     */
    private function addByName(Route $route): void
    {
        if($name = $route->getName()) {
            $this->namedRoutes[$name] = $route;
        }
    }
}
