<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client;

use Laventure\Component\Http\Client\Factory\ClientFactory;
use Laventure\Component\Http\Client\Factory\ClientFactoryInterface;
use Laventure\Component\Http\Message\Request\Factory\RequestFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;


/**
 * HttpClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\StreamClient
 */
class HttpClient implements HttpClientInterface
{

     /**
      * @var ClientFactoryInterface
     */
     private ClientFactoryInterface $clientFactory;


     /**
      * @var RequestFactoryInterface
     */
     private RequestFactoryInterface $requestFactory;


     /**
       * @param ClientFactoryInterface|null $clientFactory
       * @param RequestFactoryInterface|null $requestFactory
     */
      public function __construct(
          ClientFactoryInterface  $clientFactory = null,
          RequestFactoryInterface $requestFactory = null
      )
      {
          $this->clientFactory  = $clientFactory  ?: new ClientFactory();
          $this->requestFactory = $requestFactory ?: new RequestFactory();
      }




      /**
       * @param string $method
       * @param string $url
       * @param array $options
       * @return ResponseInterface
       * @throws ClientExceptionInterface
      */
      public function request(string $method, string $url, array $options = []): ResponseInterface
      {
           $request = $this->requestFactory->createRequest($method, $url);
           $client  = $this->clientFactory->createClient($options);
           return $client->sendRequest($request);
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
    public function delete(string $url, array $options = []): ResponseInterface
    {
        return $this->request('DELETE', $url, $options);
    }
}