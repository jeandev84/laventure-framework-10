<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Resolver\Contract;

use Psr\Container\ContainerInterface;

/**
 * DependencyResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Resolver
 */
interface ResolverInterface
{
    /**
     * @return ContainerInterface
    */
    public function getContainer(): ContainerInterface;




    /**
     * Resolve class
     *
     * @param mixed $id
     *
     * @param array $with
     *
     * @return mixed
    */
    public function resolve(string $id, array $with = []): mixed;





    /**
     * Call and resolve anonymous function
     *
     * @param callable $func
     *
     * @param array $with
     *
     * @return mixed
    */
    public function resolveAnonymous(callable $func, array $with = []): mixed;
}
