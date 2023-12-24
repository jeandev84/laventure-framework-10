<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;

use Laventure\Component\Http\Client\Service\Contract\ClientService;
use Laventure\Component\Http\Message\Response\Response;
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
        $uri      = $request->getUri();
        $url      = 'http://'. $uri->getHost() .':' . $uri->getPort() . ($uri->__toString());
        $response = new Response();
        $response->getBody()->write("Response from $url");
        return $response;
    }
}
