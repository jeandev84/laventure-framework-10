<?php
declare(strict_types=1);

namespace Laventure\Usage\Http\Client;

use Exception;
use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Client\Service\Options\AuthBasicOptions;
use Laventure\Component\Http\Message\Response\Response;

/**
 * HttpClientService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Usage\Http\Client
 */
class HttpClientService
{

     protected HttpClient $client;

     public function __construct()
     {
         $this->client = HttpClient::create();
     }




     public function get(): void
     {
         // GET Users (example)
         try {
             $response = $this->client->request( 'GET', 'http://localhost:8000/index.php', [
                 'query' => [
                     #'page' => 2,
                     'sort' => 'u.name',
                     'direction' => 'asc'
                 ]
             ]);
         } catch (Exception $e) {
             $response = new Response(500);
             $response->setContent($e->getMessage());
         }

         /* dump($response->getHeaders()); */

         echo $response;
     }





     public function post(): void
     {
         // POST
         try {
             $response = $this->client->post( 'http://localhost:8000/create.php', [
                 'body' => [
                     'username' => 'Create User',
                     'password' => '12345'
                 ]
             ]);
         } catch (Exception $e) {
             $response = new Response(500);
             $response->setContent($e->getMessage());
         }

         echo $response;


         // POST with headers
         /*
         try {
             $response = $this->client->post( 'http://localhost:8000/create.php', [
                 'headers' => [
                     'Content-Type' => 'application/json'
                 ],
                 'body' => json_encode([
                     'username' => 'brown',
                     'password' => '12345'
                 ], JSON_PRETTY_PRINT)
             ]);
         } catch (Exception $e) {
             $response = new Response(500);
             $response->setContent($e->getMessage());
         }

         echo $response;
         */
     }




     public function put(): void
     {
         // PUT
         try {
             $response = $this->client->put( 'http://localhost:8000/update.php', [
                 'body' => [
                     'username' => 'Update User',
                     'password' => '12345'
                 ]
             ]);
         } catch (Exception $e) {
             $response = new Response(500);
             $response->setContent($e->getMessage());
         }


         echo $response;
     }




    public function delete(): void
    {
        // PUT
        try {
            $response = $this->client->delete( 'http://localhost:8000/delete.php', [
                'query' => [
                   'id' => 3
                ]
            ]);
        } catch (Exception $e) {
            $response = new Response(500);
            $response->setContent($e->getMessage());
        }


        echo $response;
    }



    public function proxy(): void
    {
        // Proxy
        try {
            $response = $this->client->post( 'https://example.com', [
               'proxy' => '165.22.115.179:8080'
            ]);
        } catch (Exception $e) {
            $response = new Response(500);
            $response->setContent($e->getMessage());
        }


        echo $response;
    }



    public function auth(): void
    {
        // Auth Basic
        try {
            $response = $this->client->post( 'http://localhost:8000/auth/login.php', [
                'auth_basic' => new AuthBasicOptions('john', 'password')
            ]);
        } catch (Exception $e) {
            $response = new Response(500);
            $response->setContent($e->getMessage());
        }


        echo $response;
    }
}