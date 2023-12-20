<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Group;

/**
 * RouteGroup
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Group
*/
class RouteGroup
{
    /**
     * @var array
    */
    protected array $path = [];


    /**
     * @var array
    */
    protected array $module = [];

    /**
     * @var array
    */
    protected array $name = [];

    /**
     * @var array
    */
    protected array $middlewares = [];
}
