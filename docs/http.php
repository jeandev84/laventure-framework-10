<?php

use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Message\Request\Uri;

require 'vendor/autoload.php';


$request = ServerRequest::fromGlobals();
$request->withAttribute('user', new \PHPUnitTest\App\Entity\User(1, 'john@doe.com'));

dump($request);




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
       <form action="" method="POST" enctype="multipart/form-data">
           <div class="row">
               <div class="col-md-4">
                   <div class="form-group">
                       <label for="username">
                           Username <input type="text" name="username" id="username" value="<?= $request->request->get('username') ?>" class="form-control">
                       </label>
                   </div>
               </div>
               <div class="col-md-8">
                   <div class="form-group">
                       <label for="avatar">
                           Avatar: <input type="file" name="avatar" id="avatar">
                       </label>
                   </div>
                   <div class="form-group">
                       <label for="photos">
                           Others photos: <input type="file" name="photos[]" id="photos" multiple>
                       </label>
                   </div>

                   <div>Agree ? <input type="checkbox" name="agree"></div>
               </div>
             </div>
           <button type="submit" class="btn btn-primary mt-3">Send</button>
        </form>
   </div>
</body>
</html>


