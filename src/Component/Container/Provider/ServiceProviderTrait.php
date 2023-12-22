<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Provider;

use Laventure\Component\Container\Container;

/**
 * ServiceProviderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Provider
 */
trait ServiceProviderTrait
{
    /**
     * @var Container
     */
    protected Container $app;



    /**
     * @var array
     */
    protected array $provides = [];



    /**
     * @return array
    */
    public function getProvides(): array
    {
        return $this->provides;
    }




    /**
     * @param Container $app
     *
     * @return void
    */
    public function setContainer(Container $app): void
    {
        $this->app = $app;
    }
}
