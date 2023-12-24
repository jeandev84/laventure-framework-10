<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request\Common;

use Laventure\Component\Http\Client\Exception\NetworkException;
use Laventure\Component\Http\Client\Exception\RequestException;
use Laventure\Component\Http\Client\Request\Contract\ClientRequestInterface;
use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
use Laventure\Component\Http\Message\Response\Factory\ResponseFactory;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

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
    protected array $options = [
        'query'    => [],
        'headers'  => [],
        'body'     => ''
    ];





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
        $this->options = array_merge($this->options, $options);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }





    /**
     * @param string $name
     * @return bool
    */
    public function hasOption(string $name): bool
    {
         return isset($this->options[$name]);
    }





    /**
     * @param string $name
     * @param $default
     * @return mixed|null
    */
    public function getOption(string $name, $default = null): mixed
    {
         return $this->options[$name] ?? $default;
    }




    /**
     * @param UriInterface $uri
     * @return string
    */
    protected function resolvedUri(UriInterface $uri): string
    {
         $path = (string)$uri;

         if ($queries = $this->getOption('query', [])) {
             $path .= "?". $this->buildQueryParams($queries);
         }

         return $path;
    }




    /**
     * @param array $params
     *
     * @return string
    */
    protected function buildQueryParams(array $params): string
    {
        return http_build_query($params);
    }





    /**
     * @param string $content
     * @param int $code
     * @param string $reasonPhrase
     * @return ResponseInterface
    */
    protected function createResponse(string $content = '', int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        $factory  = new ResponseFactory();
        $response = $factory->createResponse($code, $reasonPhrase);
        $response->getBody()->write($content);
        return $response;
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
