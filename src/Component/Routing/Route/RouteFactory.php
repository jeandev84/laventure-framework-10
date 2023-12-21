<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

/**
 * RouteFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route
 */
class RouteFactory
{
    /**
     * @param string $methods
     * @param string $path
     * @param mixed $action
     * @param string $name
     * @return Route
    */
    public function make(string $methods,
        string $path,
        mixed  $action,
        string $name = ''
    ): Route {
        return new Route($methods, $path, $action, $name);
    }
}
