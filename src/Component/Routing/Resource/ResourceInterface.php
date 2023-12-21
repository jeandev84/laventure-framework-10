<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Resource;

use Laventure\Component\Routing\RouterInterface;

/**
 * ResourceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Resource
 */
interface ResourceInterface
{
    /**
     * Returns resource name
     *
     * @return string
    */
    public function getName(): string;




    /**
     * Returns resource controller
     *
     * @return string
    */
    public function getController(): string;




    /**
     * Returns resource type
     *
     * @return string
    */
    public function getType(): string;







    /**
     * Map routes
     *
     * @param RouterInterface $router
     *
     * @return mixed
    */
    public function map(RouterInterface $router): mixed;
}
