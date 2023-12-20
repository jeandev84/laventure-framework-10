<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route
 *
 * Generated By PHPStorm 20.12.2023
*/
class Route implements RouteInterface
{
    /**
     * route methods
     *
     * @var array
    */
    protected array $methods;




    /**
     * route path
     *
     * @var string
    */
    protected string $path;




    /**
     * route action
     *
     * @var mixed
    */
    protected mixed $action;




    /**
     * route path
     *
     * @var string|null
    */
    protected ?string $name;




    /**
     * route requirements
     *
     * @var array
    */
    protected array $patterns = [];



    /**
     * route middlewares
     *
     * @var array
    */
    protected array $middlewares = [];



    /**
     * route params
     *
     * @var array
    */
    protected array $params = [];



    /**
     * @var array
    */
    protected array $options = [];



    /**
     * @param array $methods
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
    */
    public function __construct(array $methods, string $path, mixed $action, ?string $name = null)
    {
        $this->methods = $methods;
        $this->path    = $this->normalizePath($path);
        $this->action  = $action;
        $this->name    = $name;
    }





    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
        return $this->methods;
    }



    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }





    /**
     * @inheritDoc
    */
    public function getAction(): mixed
    {
        return $this->action;
    }




    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return $this->params;
    }




    /**
     * @inheritDoc
    */
    public function getName(): ?string
    {
        return $this->name;
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
    public function getPatterns(): array
    {
        return $this->patterns;
    }




    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }


    /**
     * @param string $name
     *
     * @param string $pattern
     *
     * @return $this
    */
    public function where(string $name, string $pattern): static
    {
        $this->patterns[$name] = $pattern;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function generate(array $parameters = []): string
    {
        return $this->getPath() . '?' . http_build_query($parameters);
    }



    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): bool
    {
        return $this->matchMethod($method) && $this->matchPath($path);
    }


    /**
     * @param string $method
     *
     * @return bool
    */
    public function matchMethod(string $method): bool
    {
        return in_array($method, $this->methods);
    }



    /**
     * @param string $path
     *
     * @return bool
    */
    public function matchPath(string $path): bool
    {
        return true;
    }



    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {

    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {

    }




    /**
     * @param string $path
     *
     * @return string
    */
    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');

        return sprintf('/%s', $path);
    }
}
