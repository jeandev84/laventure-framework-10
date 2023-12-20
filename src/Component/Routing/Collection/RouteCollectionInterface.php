<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Collection;


use Laventure\Component\Routing\Route\Route;

/**
 * RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Collection
 */
interface RouteCollectionInterface
{


    /**
     * @param Route $route
     *
     * @return mixed
    */
    public function addRoute(Route $route): mixed;




    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasRoute(string $name): bool;





    /**
     * @param string $name
     *
     * @return Route|null
    */
    public function getRoute(string $name): ?Route;





    /**
     * @param string $name
     *
     * @return mixed
    */
    public function remove(string $name): mixed;






    /**
     * @return Route[]
    */
    public function getRoutes(): array;







    /**
     * @return Route[]
    */
    public function getNamedRoutes(): array;






    /**
     * Remove all routes
     *
     * @return void
    */
    public function clear(): void;
}