<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Group;

use Laventure\Component\Routing\Group\Invoker\RouteGroupInvokerInterface;

/**
 * RouteGroupInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Group
*/
interface RouteGroupInterface
{
    /**
     * @param RouteGroupInvokerInterface $invoker
     *
     * @return mixed
    */
    public function group(RouteGroupInvokerInterface $invoker): mixed;





    /**
     * Returns group path
     *
     * @return string
    */
    public function getPath(): string;






    /**
     * Returns group name
     *
     * @return string
    */
    public function getName(): string;





    /**
     * Returns full namespace
     *
     * @return string
    */
    public function getNamespace(): string;





    /**
     * Returns group middlewares
     *
     * @return array
    */
    public function getMiddlewares(): array;







    /**
     * @return void
    */
    public function clear(): void;
}
