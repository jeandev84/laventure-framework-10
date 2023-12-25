<?php
declare(strict_types=1);

namespace Laventure\Usage\Http\Client;

use Exception;
use Laventure\Component\Http\Client\HttpClient;
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
         try {
             $response = $this->client->request( 'GET', 'http://localhost:8000/index.php', [
                 'query' => [
                     'page' => 2, 'sort' => 'u.name', 'direction' => 'asc'
                 ]
             ]);
         } catch (Exception $e) {
             $response = new Response(500);
             $response->setContent($e->getMessage());
         }

         echo $response;
     }





     public function post(): void
     {
         // POST
         try {
             $response = $this->client->post( 'http://localhost:8000/create.php', [
                 'body' => [
                     'username' => 'brown',
                     'password' => '12345'
                 ]
             ]);
         } catch (Exception $e) {
             $response = new Response(500);
             $response->setContent($e->getMessage());
         }

         echo $response;
     }




     public function put(): void
     {
         // PUT
         try {
             $response = $this->client->put( 'http://localhost:8000/update.php', [
                 'body' => [
                     'username' => 'brown',
                     'password' => '12345'
                 ]
             ]);
         } catch (Exception $e) {
             $response = new Response(500);
             $response->setContent($e->getMessage());
         }


         echo $response;
     }
}