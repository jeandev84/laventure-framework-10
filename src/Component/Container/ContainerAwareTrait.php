<?php

declare(strict_types=1);

namespace Laventure\Component\Container;

/**
 * ContainerAwareTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container
 */
trait ContainerAwareTrait
{
    /**
     * @var Container
    */
    protected Container $container;




    /**
     * @param Container $container
     *
     * @return void
    */
    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }



    /**
     * @return Container
    */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
