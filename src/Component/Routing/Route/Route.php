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
     * @var string route path
    */
    protected string $path;





    /**
     * route pattern
     *
     * @var string
    */
    protected string $pattern;





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
     * route patterns
     *
     * @var array
    */
    protected array $patterns = [];




    /**
     * route patterns
     *
     * @var array
    */
    private static array $wheres = [];





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
     * @param array|string $methods
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
    */
    public function __construct(
        array|string $methods,
        string $path,
        mixed $action,
        string $name = null
    ) {

        $this->methods($methods)
             ->path($path)
             ->action($action)
             ->name($name);
    }




    /**
     * @param array|string $methods
     *
     * @return $this
    */
    public function methods(array|string $methods): static
    {
        $this->methods = $this->resolveMethods($methods);

        return $this;
    }




    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->path = $this->normalizePath($path);

        $this->pattern($this->path);

        return $this;
    }




    /**
     * @param mixed $action
     *
     * @return $this
    */
    public function action(mixed $action): static
    {
        if (is_array($action)) {
            $action = $this->resolveActionFromArray($action);
        }

        $this->action = $action;

        return $this;
    }




    /**
     * @param callable $action
     *
     * @return $this
    */
    public function callback(callable $action): static
    {
        return $this->action($action);
    }





    /**
     * @param $name
     *
     * @return $this
    */
    public function name($name): static
    {
        $this->name = $name;

        return $this;
    }







    /**
     * @param string $pattern
     *
     * @return $this
    */
    public function pattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }





    /**
     * @param array $params
     *
     * @return $this
    */
    public function params(array $params): static
    {
        $this->params = $params;

        return $this;
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
    public function getMethod(string $separator = '|'): string
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




    /**
     * @return string
    */
    public function getPattern(): string
    {
        return $this->pattern;
    }




    /**
     * Returns the name of controller or request handler
     *
     * @return string|null
    */
    public function getController(): ?string
    {
        return $this->getOption('controller');
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
            if (!empty(self::$wheres[$name])) {
                $path = preg_replace(
                    array_keys(self::$wheres[$name]),
                    [$value, $value],
                    $path
                );
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
     * @param string $uri
     *
     * @return bool
    */
    public function matchPath(string $uri): bool
    {
        $path    = $this->normalizeRequestPath($uri);
        $pattern = $this->getPattern();

        if(preg_match("#^$pattern$#i", $path, $matches)) {
            $this->params  = $this->resolveParams($matches);
            $this->options(compact('uri'));
            return true;
        }

        return false;
    }





    /**
     * @param array $options
     *
     * @return $this
    */
    public function options(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }



    /**
     * Determine if the given name exist in options
     *
     * @param string $name
     *
     * @return bool
    */
    public function hasOption(string $name): bool
    {
        return isset($this->options[$name]);
    }





    /**
     * @param string $name
     *
     * @param $default
     *
     * @return mixed
    */
    public function getOption(string $name, $default = null): mixed
    {
        return $this->options[$name] ?? $default;
    }







    /**
     * @inheritDoc
    */
    public function callable(): bool
    {
        return is_callable($this->action);
    }





    /**
     * @return array
    */
    public function toArray(): array
    {
        return get_object_vars($this);
    }




    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return property_exists($this, $offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        if (!$this->offsetExists($offset)) {
            return false;
        }

        return $this->{$offset};
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($this->offsetExists($offset)) {
            $this->{$offset} = $value;
        }
    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->{$offset});
        }
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
     * @param string $path
     *
     * @return string
    */
    private function normalizeRequestPath(string $path): string
    {
        return parse_url($path, PHP_URL_PATH);
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
        $this->pattern = preg_replace(array_keys($patterns), array_values($patterns), $this->pattern);

        return $patterns;
    }




    /**
     * @param array $matches
     *
     * @return array
    */
    private function resolveParams(array $matches): array
    {
        return array_filter($matches, function ($key) {
            return !is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);
    }




    /**
     * @param array|string $methods
     *
     * @return array
    */
    private function resolveMethods(array|string $methods): array
    {
        if (is_string($methods)) {
            $methods = explode('|', $methods);
        }

        return $methods;
    }




    /**
     * @param array $callback
     *
     * @return string
    */
    private function resolveActionFromArray(array $callback): string
    {
        [$controller, $action] = $callback;

        $this->options(compact('controller', 'action'));

        return join('@', $callback);
    }
}
