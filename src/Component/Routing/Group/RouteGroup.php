<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Group;

use Laventure\Component\Routing\Group\DTO\RouteGroupAttributes;
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
     * Base namespace
     *
     * @var string
    */
    private string $namespace;



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
    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;

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
        if (!empty($this->namespaces)) {
            return join("\\", $this->namespaces);
        }

        return trim($this->namespace, '\\');
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
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static
    {
        $this->middlewares = array_merge(
            $this->middlewares,
            $middlewares
        );

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function group(RouteGroupInvokerInterface $invoker): mixed
    {
        $this->add($invoker->attributes());
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
        $this->path   = [];
        $this->namespaces = [];
        $this->middlewares = [];
        $this->name = [];
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
        if ($prefix = $this->getPath()) {
            $path = sprintf(
                '%s/%s',
                trim($prefix, '/'),
                ltrim($path, '/')
            );
        }

        return $path;
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
        return sprintf('%s%s', $this->getName(), $name);
    }




    /**
     * @param mixed $action
     *
     * @return mixed
     */
    public function resolveAction(mixed $action): mixed
    {
        if ($this->hasSymbolArobase($action)) {
            $action     = explode('@', $action, 2);
            $controller = sprintf('%s\\%s', $this->getNamespace(), $action[0]);
            return [$controller, $action[1]];
        }

        return $action;
    }






    /**
     * @param RouteGroupAttributes $attributes
     *
     * @return void
     */
    private function add(RouteGroupAttributes $attributes): void
    {
        $this->path($attributes->path)
             ->namespace($attributes->namespace)
             ->name($attributes->name)
             ->middlewares($attributes->middlewares);
    }


    /**
     * @param $action
     *
     * @return bool
    */
    private function hasSymbolArobase($action): bool
    {
        return is_string($action) && stripos($action, '@') !== false;
    }
}
