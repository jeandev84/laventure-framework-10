<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request\Common;

use Laventure\Component\Http\Client\Exception\NetworkException;
use Laventure\Component\Http\Client\Exception\RequestException;
use Laventure\Component\Http\Client\Request\Contract\ClientRequestInterface;
use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
use Laventure\Component\Http\Message\Response\Factory\ResponseFactory;
use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * ClientRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request\Common
 */
abstract class ClientRequest implements ClientRequestInterface
{


    protected array $options = [];


    /**
     * @param ClientServiceInterface $service
    */
    public function __construct(protected ClientServiceInterface $service)
    {

    }




    /**
     * @inheritDoc
    */
    public function withOptions(array $options): static
    {
        $this->options = $options;

        return $this;
    }






    /**
     * @param string $content
     * @param int $statusCode
     * @param array $headers
     * @return ResponseInterface
    */
    protected function createResponse(string $content = '', int $statusCode = 200, array $headers = []): ResponseInterface
    {
        $response =  new Response($statusCode, $headers);
        $response->getBody()->write($content);
        return $response;
    }




    /**
     * @return ResponseInterface
    */
    protected function respond(): ResponseInterface
    {
         return $this->createResponse(
              $this->service->getBody(),
              $this->service->getStatus(),
              $this->service->getHeaders()
         );
    }





    /**
     * @param RequestInterface $request
     * @param \Throwable $e
     * @return NetworkExceptionInterface
     */
    protected function createNetworkException(RequestInterface $request, \Throwable $e): NetworkExceptionInterface
    {
        return new NetworkException($request, $e->getMessage(), $e->getCode());
    }





    /**
     * @param RequestInterface $request
     * @param \Throwable $e
     * @return RequestExceptionInterface
    */
    protected function createRequestException(RequestInterface $request, \Throwable $e): RequestExceptionInterface
    {
        return new RequestException($request, $e->getMessage(), $e->getCode());
    }
}
