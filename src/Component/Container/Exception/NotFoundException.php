<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * NotFoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Exception
 */
class NotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
