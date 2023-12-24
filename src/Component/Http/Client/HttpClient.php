<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client;


use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
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
      * @var ClientServiceInterface
     */
     protected ClientServiceInterface $service;



     /**
      * @param ClientServiceInterface $service
     */
     public function __construct(ClientServiceInterface $service)
     {
         $this->service = $service;
     }




    /**
     * @inheritDoc
     *
     * @throws ClientExceptionInterface
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
          return $this->service->withOptions($options)->sendRequest(new Request($method, $url));
    }





    /**
     * @inheritDoc
     * @throws ClientExceptionInterface
     */
    public function get(string $url, array $options = []): ResponseInterface
    {
         return $this->request('GET', $url, $options);
    }





    /**
     * @inheritDoc
     * @throws ClientExceptionInterface
     */
    public function post(string $url, array $options = []): ResponseInterface
    {
        return $this->request('POST', $url, $options);
    }


    /**
     * @inheritDoc
     * @throws ClientExceptionInterface
    */
    public function put(string $url, array $options = []): ResponseInterface
    {
         return $this->request('PUT', $url, $options);
    }




    /**
     * @inheritDoc
     * @throws ClientExceptionInterface
    */
    public function patch(string $url, array $options = []): ResponseInterface
    {
         return $this->request('PATCH', $url, $options);
    }





    /**
     * @inheritDoc
    */
    public function delete(string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement delete() method.
    }
}