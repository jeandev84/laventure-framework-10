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
    public function attributes(): RouteGroupAttributes;




    /**
     * @return callable
    */
    public function routes(): callable;






    /**
     * @return RouterInterface
    */
    public function router(): RouterInterface;





    /**
     * Call routes to map
     *
     * @return mixed
    */
    public function invoke(): mixed;
}
