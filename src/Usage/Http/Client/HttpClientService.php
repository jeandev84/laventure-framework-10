<?php
declare(strict_types=1);

namespace Laventure\Usage\Http\Client;

use Exception;
use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Client\Service\Files\ClientFile;
use Laventure\Component\Http\Client\Service\Options\AuthBasic;
use Laventure\Component\Http\Client\Service\Options\AuthToken;
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




    public function json(): void
    {
        // PUT
        try {
            $response = $this->client->put( 'http://localhost:8000/json/data.php', [
                'json' => json_encode([
                    'username' => 'brown',
                    'job'      => 'Developer',
                    'city'     => 'CIV'
                ])
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
                'auth_basic' => new AuthBasic('john', 'password')
            ]);
        } catch (Exception $e) {
            $response = new Response(500);
            $response->setContent($e->getMessage());
        }


        echo $response;
    }




    public function authToken(): void
    {
        // Auth Basic
        try {
            $response = $this->client->post( 'http://localhost:8000/auth/token.php', [
                'auth_token' => new AuthToken(md5(uniqid()))
            ]);
        } catch (Exception $e) {
            $response = new Response(500);
            $response->setContent($e->getMessage());
        }


        echo $response;
    }





    public function files(): void
    {
        // Auth Basic
        try {
            $response = $this->client->post( 'http://localhost:8000/uploads/upload.php', [
                'files' => [
                    'avatar1' => new ClientFile( __DIR__.'/files/1.jpg', 'image/jpg', '1.jpg'),
                    'avatar2' => new ClientFile(__DIR__.'/files/2.png', 'image/png', '2.png'),
                ],
                'body' => [
                    'username' => 'Brown',
                    'email'    => 'brown@demo.ru'
                ]
            ]);
        } catch (Exception $e) {
            $response = new Response(500);
            $response->setContent($e->getMessage());
        }


        echo $response;

        /*
             Array
             (
                [username] => Brown
                [email] => brown@demo.ru
             )

             Array
             (
                [avatar1] => Array
                    (
                        [name] => 1.jpg
                        [full_path] => 1.jpg
                        [type] => image/jpg
                        [tmp_name] => /tmp/phpZqWsHv
                        [error] => 0
                        [size] => 118597
                    )

                [avatar2] => Array
                    (
                        [name] => 2.png
                        [full_path] => 2.png
                        [type] => image/png
                        [tmp_name] => /tmp/phpJiWjwT
                        [error] => 0
                        [size] => 4590
                    )

            )

        */
    }
}