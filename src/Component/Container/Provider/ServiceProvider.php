<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Provider;

use Laventure\Component\Container\Common\ContainerAwareInterface;
use Laventure\Component\Container\Common\ContainerAwareTrait;
use Laventure\Component\Container\Container;
use Laventure\Component\Container\Provider\Contract\ServiceProviderInterface;

/**
 * ServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Provider
 */
abstract class ServiceProvider implements ServiceProviderInterface
{
    use ServiceProviderTrait;
}
