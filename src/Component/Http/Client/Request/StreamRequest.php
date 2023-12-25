<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use Laventure\Component\Http\Client\Request\Common\ClientRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * StreamRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class StreamRequest extends ClientRequest
{
    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $method   = $request->getMethod();
        $uri      = (string)$request->getUri();

        return $this->createResponse("Response from $uri|$method");
    }
}
