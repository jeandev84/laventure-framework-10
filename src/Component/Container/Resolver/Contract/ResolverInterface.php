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
       * @param mixed $id
       *
       * @param array $parameters
       *
       * @return mixed
      */
      public function resolve(string $id, array $parameters = []): mixed;





      /**
       * @param callable $func
       *
       * @param array $parameters
       *
       * @return mixed
      */
      public function resolveAnonymous(callable $func, array $parameters = []): mixed;
}