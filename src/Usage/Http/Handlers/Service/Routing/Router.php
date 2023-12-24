<?php

declare(strict_types=1);

namespace Laventure\Usage\Http\Handlers\Service\Routing;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Usage\Http\Handlers\Service\Routing
 */
class Router
{
    protected array $routes = [];

    protected bool $success = false;


    protected $route;

    public function match(ServerRequestInterface $request): self
    {
        $method = $request->getMethod();
        $path   = $request->getUri()->getPath();

        if (isset($this->routes[$method][$path])) {
            $this->success = true;
        }

        return $this;
    }




    /**
     * @return bool
    */
    public function isSuccess(): bool
    {
        return $this->success;
    }



    public function getHandler()
    {
        return new RouterHandler($this);
    }
}
