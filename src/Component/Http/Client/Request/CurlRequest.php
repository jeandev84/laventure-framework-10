<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use Exception;
use Laventure\Component\Http\Client\Request\Common\ClientRequest;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOption;
use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;
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

            return $this->service->uri((string)$request->getUri())
                                 ->method($request->getMethod())
                                 ->options(new ClientServiceOption($this->options))
                                 ->send();

        } catch (\Throwable $e) {

           $this->abort($request, $e);
        }
    }





    /**
     * @param RequestInterface $request
     * @param \Throwable $e
     * @return mixed
     * @throws NetworkExceptionInterface
     * @throws RequestExceptionInterface
    */
    protected function abort(RequestInterface $request, \Throwable $e): mixed
    {
        $code = $e->getCode();

        throw match ($code) {
            self::NETWORK_EXCEPTION_CODE  => $this->createNetworkException($request, $e),
            default                       => $this->createRequestException($request, $e)
        };
    }
}
