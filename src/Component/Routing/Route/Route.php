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
     * route patterns
     *
     * @var array
    */
    protected static array $wheres = [];





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
     * Returns methods as string
     *
     * @param string $separator
     *
     * @return string
    */
    public function toStringMethods(string $separator = '|'): string
    {
        return join($separator, $this->methods);
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




    public function getController(): ?string
    {
        return '';
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
     * @param string $middleware
     *
     * @return $this
    */
    public function middleware(string $middleware): static
    {
        $this->middlewares[] = $middleware;

        return $this;
    }




    /**
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static
    {
        foreach ($middlewares as $middleware) {
            $this->middleware($middleware);
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
    public function where(string $name, string $pattern): static
    {
        $patterns                  = $this->makePatterns($name, $pattern);
        static::$wheres[$name]     = $this->replacePatterns($patterns);
        $this->patterns[$name]     = $pattern;

        return $this;
    }




    /**
     * @param array $wheres
     *
     * @return $this
    */
    public function wheres(array $wheres): static
    {
        foreach ($wheres as $name => $value) {
            $this->where($name, $value);
        }

        return $this;
    }




    /**
     * @return $this
    */
    public function id(): self
    {
        return $this->number('id');
    }




    /**
     * @param string $name
     * @return $this
     */
    public function number(string $name): self
    {
        return $this->where($name, '\d+');
    }






    /**
     * @param string $name
     * @return $this
     */
    public function text(string $name): self
    {
        return $this->where($name, '\w+');
    }






    /**
     * @param string $name
     * @return $this
     */
    public function alphaNumeric(string $name): self
    {
        return $this->where($name, '[^a-z_\-0-9]');
    }





    /**
     * @param string $name
     *
     * @return $this
    */
    public function slug(string $name): self
    {
        return $this->where($name, '[a-z\-0-9]+');
    }






    /**
     * @param string $name
     *
     * @return $this
     */
    public function anything(string $name): self
    {
        return $this->where($name, '.*');
    }





    /**
     * @inheritDoc
    */
    public function generateUri(array $parameters = []): string
    {
        $path = $this->getPath();

        foreach ($parameters as $name => $value) {
            if (! empty(self::$wheres[$name])) {
                $path = preg_replace(array_keys(self::$wheres[$name]), [$value, $value], $path);
            }
        }

        return $path;
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
        return sprintf('/%s', trim($path, '/'));
    }




    /**
     * @param string $name
     *
     * @param string $pattern
     *
     * @return string[]
    */
    private function makePatterns(string $name, string $pattern): array
    {
        $pattern = str_replace('(', '(?:', $pattern);

        return ["#{{$name}}#" => "(?P<$name>$pattern)", "#{{$name}.?}#" => "?(?P<$name>$pattern)?"];
    }




    /**
     * @param array $patterns
     *
     * @return array
    */
    private function replacePatterns(array $patterns): array
    {
        $this->path = preg_replace(array_keys($patterns), array_values($patterns), $this->getPath());

        return $patterns;
    }
}