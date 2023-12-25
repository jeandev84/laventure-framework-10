<?php

# header('HTTP/1.0 200 OK');

print_r($_SERVER);

echo $_SERVER['REQUEST_METHOD'];

parse_str(file_get_contents('php://input'), $data);

echo json_encode($data);