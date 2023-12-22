<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Common;

use Laventure\Component\Container\Container;

/**
 * ContainerAwareInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Container
 */
interface ContainerAwareInterface
{
    /**
     * @param Container $container
     *
     * @return void
    */
    public function setContainer(Container $container): void;




    /**
     * @return Container
    */
    public function getContainer(): Container;
}
