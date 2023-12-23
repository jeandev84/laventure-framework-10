<?php

use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Http\Message\Response\Body\ResponseBody;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Http\Message\Response\Status\ResponseStatus;
use Laventure\Component\Http\Message\Stream\Stream;

require 'vendor/autoload.php';


$response = new Response();

$response->getBody()->write('<h1>Hello world</h1>');

echo $response;


$response = new \Laventure\Component\Http\Message\Response\JsonResponse([
    'id' => 1,
    'username' => 'john',
    'avatar_url' => '/uploads/users/1-avatar.jpg',
    'is_active'  => true
]);

echo $response;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="username">
                        Username <input type="text" name="username" id="username" value="" class="form-control">
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Send</button>
    </form>
</div>
</body>
</html>





