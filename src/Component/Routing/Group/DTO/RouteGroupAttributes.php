<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Group\DTO;

/**
 * RouteGroupAttributes
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Group\DTO
 */
class RouteGroupAttributes
{

    /**
     * @param string $path
     *
     * @param string $namespace
     *
     * @param string $name
     *
     * @param array $middlewares
    */
    public function __construct(
        public string $path,
        public string $namespace,
        public string $name,
        public array  $middlewares
    )
    {
    }
}