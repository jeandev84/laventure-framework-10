<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use Laventure\Component\Http\Client\Request\Common\ClientRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * CurlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class CurlRequest extends ClientRequest
{
    const NETWORK_EXCEPTION_CODE = 7;



    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {

            $this->service->url($this->resolvedUri($request->getUri()));
            $this->service->method($request->getMethod());
            $this->service->send();

            return $this->createResponse($this->service->getBody(), $this->service->getStatusCode());

        } catch (\Throwable $e) {

            $code = $e->getCode();

            throw match ($code) {
                self::NETWORK_EXCEPTION_CODE  => $this->createNetworkException($request, $e),
                default                       => $this->createRequestException($request, $e)
            };
        }
    }
}
