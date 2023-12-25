<?php

header('Content-Type: application/json; charset=UTF-8');

/* print_r($_GET); */

echo json_encode([
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
    ],
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

/*
echo php_sapi_name();
phpinfo();
*/