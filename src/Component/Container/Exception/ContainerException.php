<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Exception;

use Psr\Container\ContainerExceptionInterface;

/**
 * ContainerException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Exception
 */
class ContainerException extends \Exception implements ContainerExceptionInterface
{
}
