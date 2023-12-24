<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Kernel;

use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;

/**
 * TerminableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Kernel
 */
interface TerminableInterface
{
    /**
     * @param Request $request
     *
     * @param Response $response
     *
     * @return mixed
    */
    public function terminate(Request $request, Response $response): mixed;
}
