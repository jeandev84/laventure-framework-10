<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use Laventure\Component\Http\Client\Request\Common\ClientRequest;
use Laventure\Component\Http\Message\Response\Response;
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

            $this->service->url((string)$request->getUri());
            $this->service->method($request->getMethod());
            $this->service->parseOptions($this->options);
            $this->service->send();

            return $this->createResponseFromService();

        } catch (\Throwable $e) {

            $code = $e->getCode();

            throw match ($code) {
                self::NETWORK_EXCEPTION_CODE  => $this->createNetworkException($request, $e),
                default                       => $this->createRequestException($request, $e)
            };
        }
    }
}
