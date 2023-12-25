<?php

header('HTTP/1.0 201 Created');

echo $_SERVER['REQUEST_METHOD'];

print_r($_POST);

file_put_contents(__DIR__.'/uploads/demo.txt', 'Hello friends');

echo json_encode([
    'success' => 'OK Posted'
]);
