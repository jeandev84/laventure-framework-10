<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Handlers\Kernel;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
     * @param ServerRequestInterface $request
     *
     * @param ResponseInterface $response
     *
     * @return mixed
    */
    public function terminate(ServerRequestInterface $request, ResponseInterface $response): mixed;
}
