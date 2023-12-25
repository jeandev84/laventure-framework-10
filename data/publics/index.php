<?php

require __DIR__ .'/../vendor/autoload.php';

$response = new \Laventure\Component\Http\Message\Response\JsonResponse([
    [
        'id' => 1,
        'username'   => 'Jean-Claude',
        'email'      => 'john@yandex.ru',
        'avatar_url' => 'http://placeholder/it/150x200',
        'position'   => 'Developer',
        'country'    => 'Russia Federation'
    ],
    [
        'id' => 2,
        'username'   => 'Marry',
        'email'      => 'marry@live.fr',
        'avatar_url' => 'http://placeholder/it/150x200',
        'position'   => 'Doctor Geography',
        'country'    => 'CIV'
    ]
]);


echo $response;