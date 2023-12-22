<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Services;

use Laventure\Component\Container\Container;

/**
 * FooService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Services
 */
class FooService
{

    protected Container $container;

    protected string $demo;


    public function __construct(Container $container, string $demo)
    {
        $this->container = $container;
        $this->demo      = $demo;
    }


    /**
     * @return string
    */
    public function getDemo(): string
    {
        return $this->demo;
    }
}