<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client;

use Laventure\Component\Http\Client\Exception\ClientException;
use Laventure\Component\Http\Client\Request\Contract\ClientRequestInterface;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Client\Request\Factory\CurlRequestFactory;
use Laventure\Component\Http\Message\Request\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * HttpClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client
*/
class HttpClient implements HttpClientInterface
{
    /**
     * @var ClientRequestInterface
    */
    protected ClientRequestInterface $client;





    /**
     * @param ClientRequestInterface $client
    */
    public function __construct(ClientRequestInterface $client)
    {
        $this->client = $client;
    }




    /**
     * @return static
    */
    public static function create(): static
    {
        return new self(CurlRequestFactory::create());
    }


    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientException
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        try {
            return $this->client->withOptions($options)->sendRequest(new Request($method, $url));
        } catch (\Throwable $e) {
             throw new ClientException($e->getMessage(), $e->getCode(), $e);
        }
    }






    /**
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
    */
    public function get(string $url, array $options = []): ResponseInterface
    {
        return $this->request('GET', $url, $options);
    }





    /**
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
    */
    public function post(string $url, array $options = []): ResponseInterface
    {
        return $this->request('POST', $url, $options);
    }






    /**
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
    */
    public function put(string $url, array $options = []): ResponseInterface
    {
        return $this->request('PUT', $url, $options);
    }







    /**
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
    */
    public function patch(string $url, array $options = []): ResponseInterface
    {
        return $this->request('PATCH', $url, $options);
    }





    /**
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
    */
    public function delete(string $url, array $options = []): ResponseInterface
    {
        return $this->request('DELETE', $url, $options);
    }
}
