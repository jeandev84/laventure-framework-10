<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Handlers\Kernel;

use Psr\Http\Server\RequestHandlerInterface;

/**
 * HttpKernelInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Handlers\Kernel
 */
interface HttpKernelInterface extends RequestHandlerInterface, TerminableInterface
{
}
