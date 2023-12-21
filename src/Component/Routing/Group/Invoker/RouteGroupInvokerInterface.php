<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Group\Invoker;

use Laventure\Component\Routing\Group\DTO\RouteGroupAttributes;
use Laventure\Component\Routing\RouterInterface;

/**
 * RouteGroupInvokerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Group\Invoker
 */
interface RouteGroupInvokerInterface
{


    /**
     * Returns prefixes or attributes of routes to invoke
     *
     * @return RouteGroupAttributes
    */
    public function getAttributes(): RouteGroupAttributes;




    /**
     * @return callable
    */
    public function getRoutes(): callable;






    /**
     * @return RouterInterface
    */
    public function getRouter(): RouterInterface;





    /**
     * Call routes to map
     *
     * @return mixed
    */
    public function invoke(): mixed;
}
