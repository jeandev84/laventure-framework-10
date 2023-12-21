<?php
declare(strict_types=1);

namespace Laventure\Component\Routing;

use Closure;
use Laventure\Component\Routing\Collection\RouteCollection;
use Laventure\Component\Routing\Enums\HttpMethod;
use Laventure\Component\Routing\Group\Invoker\RouteGroupInvoker;
use Laventure\Component\Routing\Group\RouteGroup;
use Laventure\Component\Routing\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Resource\Resource;
use Laventure\Component\Routing\Resource\Types\ApiResource;
use Laventure\Component\Routing\Resource\Types\WebResource;
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




    /**
     * @var RouteGroup
    */
    protected RouteGroup $group;



    /**
     * @var array
    */
    protected array $patterns = [];




    /**
     * @var Resource[]
    */
    public array $resources = [];





    /**
     * @param string $namespace
    */
    public function __construct(string $namespace = '')
    {
        $this->collection   = new RouteCollection();
        $this->routeFactory = new RouteFactory();
        $this->group        = new RouteGroup($namespace);
    }




    /**
     * @param array $patterns
     *
     * @return $this
    */
    public function patterns(array $patterns): static
    {
         foreach ($patterns as $name => $pattern) {
             $this->pattern($name, $pattern);
         }

         return $this;
    }




    /**
     * @param string $name
     *
     * @param string $pattern
     *
     * @return $this
    */
    public function pattern(string $name, string $pattern): static
    {
        $this->patterns[$name] = $pattern;

        return $this;
    }





    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->group->path($path);

        return $this;
    }





    /**
     * @param string $namespace
     *
     * @return $this
    */
    public function namespace(string $namespace): static
    {
        $this->group->namespace($namespace);

        return $this;
    }




    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
        $this->group->name($name);

        return $this;
    }







    /**
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static
    {
        $this->group->middlewares($middlewares);

        return $this;
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
     * @param Resource $resource
     *
     * @return $this
    */
    public function addResource(Resource $resource): static
    {
        $type = $resource->getType();
        $name = $resource->getName();

        $this->pattern('id', '\d+');
        $this->pattern($name, '\d+');

        $resource->map($this);

        $this->resources[$type][$name] = $resource;

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function map(string $methods, string $path, mixed $action, string $name = null): Route
    {
        return $this->add($this->makeRoute($methods, $path, $action, $name));
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
     * Map route called by method PATCH
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function patch(string $path, mixed $action, string $name = null): Route
    {
        return $this->map(HttpMethod::PATCH, $path, $action, $name);
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
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
     */
    public function resource(string $name, string $controller): static
    {
        return $this->addResource(new WebResource($name, $controller));
    }







    /**
     * @param array $resources
     *
     * @return $this
    */
    public function resources(array $resources): static
    {
        foreach ($resources as $name => $controller) {
            $this->resource($name, $controller);
        }

        return $this;
    }





    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasResource(string $name): bool
    {
        return isset($this->resources[ResourceType::WEB][$name]);
    }






    /**
     * @param string $name
     *
     * @return WebResource|null
    */
    public function getResource(string $name): ?WebResource
    {
        return $this->resources[ResourceType::WEB][$name] ?? null;
    }







    /**
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
     */
    public function apiResource(string $name, string $controller): static
    {
        return $this->addResource(new ApiResource($name, $controller));
    }






    /**
     * @param array $resources
     *
     * @return $this
     */
    public function apiResources(array $resources): static
    {
        foreach ($resources as $name => $controller) {
            $this->apiResource($name, $controller);
        }

        return $this;
    }






    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasApiResource(string $name): bool
    {
        return isset($this->resources[ResourceType::API][$name]);
    }





    /**
     * @param string $name
     *
     * @return ApiResource|null
     */
    public function getApiResource(string $name): ?ApiResource
    {
        return $this->resources[ResourceType::API][$name] ?? null;
    }











    /**
     * @inheritDoc
    */
    public function group(array $attributes, Closure $routes): mixed
    {
        $this->group->group(new RouteGroupInvoker($attributes, $routes, $this));

        return $this;
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






    /**
     * @return RouteGroup
    */
    public function getGroup(): RouteGroup
    {
        return $this->group;
    }




    /**
     * @param string $methods
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function makeRoute(string $methods, string $path, mixed $action, string $name = null): Route
    {
        $path   = $this->group->resolvePath($path);
        $action = $this->group->resolveAction($action);
        $name   = $this->group->resolveName((string)$name);

        $route = $this->routeFactory->make($methods, $path, $action, $name);
        $route->middlewares($this->group->getMiddlewares());

        return $route;
    }
}
