<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use Laventure\Component\Http\Client\Request\Contract\ClientRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * StreamClientService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service
*/
class StreamRequest extends ClientRequest
{
    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $method   = $request->getMethod();
        $uri      = $this->resolvedUri($request->getUri());

        return $this->createResponse("Response from $uri|$method");
    }
}
