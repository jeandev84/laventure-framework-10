<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Kernel;

use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;

/**
 * HttpKernelInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Kernel
 */
interface HttpKernelInterface extends TerminableInterface
{
    /**
     * @param Request $request
     *
     * @return Response
    */
    public function handle(Request $request): Response;
}
