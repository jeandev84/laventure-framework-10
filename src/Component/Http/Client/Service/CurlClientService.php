<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;

use Laventure\Component\Http\Client\Exception\NetworkException;
use Laventure\Component\Http\Client\Exception\RequestException;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Client\Service\Contract\ClientService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * CurlClientService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service
*/
class CurlClientService extends ClientService
{
    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {

            $client = new CurlRequest($this->resolvedUri($request->getUri()));
            $client->method($request->getMethod());
            $client->send();

            return $this->createResponse($client->getBody(), $client->getStatusCode());

        } catch (\Throwable $e) {

            $code = $e->getCode();

            return match ($code) {
                7       => throw new NetworkException($request, $e->getMessage(), $e->getCode()),
                default => throw new RequestException($request, $e->getMessage(), $e->getCode())
            };
        }
    }
}
