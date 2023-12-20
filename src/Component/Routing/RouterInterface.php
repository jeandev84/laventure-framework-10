<?php

declare(strict_types=1);

namespace Laventure\Component\Routing;

use Laventure\Component\Routing\Route\Route;

/**
 * RouterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing
*/
interface RouterInterface
{
    /**
     * Map routes by given methods
     *
     * @param string $methods Map methods by pipe like "GET|POST" ...
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function map(string $methods, string $path, mixed $action, string $name = null): Route;






    /**
     * Map routes by method GET
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function get(string $path, mixed $action, string $name = null): Route;






    /**
     * Map routes by method POST
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function post(string $path, mixed $action, string $name = null): Route;






    /**
     * Map routes by method PUT
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function put(string $path, mixed $action, string $name = null): Route;






    /**
     * Map routes by method DELETE
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function delete(string $path, mixed $action, string $name = null): Route;





    /**
     * Determine if the current request match route
     *
     * @param string $method
     *
     * @param string $path
     *
     * @return Route|false
    */
    public function match(string $method, string $path): Route|false;







    /**
     * Generate URI
     *
     * @param string $name
     *
     * @param array $parameters
     *
     * @return string|null
    */
    public function generate(string $name, array $parameters = []): ?string;







    /**
     * Returns routes
     *
     * @return Route[]
    */
    public function getRoutes(): array;
}
