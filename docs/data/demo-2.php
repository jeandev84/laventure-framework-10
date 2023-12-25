<?php

use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Message\Response\Response;

require 'vendor/autoload.php';

$client = HttpClient::create();


/*
// GET
try {
    $response = $client->request( 'GET', 'http://localhost:8000/index.php', [
        'query' => ['page' => 2, 'sort' => 'u.name', 'direction' => 'asc']
    ]);
} catch (Exception $e) {
    $response = new Response(500);
    $response->setContent($e->getMessage());
}

echo $response;

echo "\n==========================================================================================\n";

// POST
try {
    $response = $client->post( 'http://localhost:8000/create.php', [
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

echo "\n===========================================================================================\n";
*/

// PUT
try {
    $response = $client->put( 'http://localhost:8000/update.php', [
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


?>

