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
       * @param mixed $value
       *
       * @param array $parameters
       *
       * @return mixed
      */
      public function resolve(mixed $value, array $parameters = []): mixed;
}