<?php

require 'vendor/autoload.php';




/*

$dotenv = new \Laventure\Component\Dotenv\Dotenv(__DIR__);

$dotenv->load();

$config = [
  'app.mode'   => $_ENV['APP_ENV'],
  'app.debug'  => $_ENV['APP_DEBUG'],
  'db'         => [
      'driver'     => $_ENV['DB_DRIVER'],
      'host'       => $_ENV['DB_HOST'],
      'username'   => $_ENV['DB_USER'],
      'password'   => $_ENV['DB_PASS'],
      'name'       => $_ENV['DB_DATABASE']
  ]
];

dd($config);

dump($_ENV);
dump($_SERVER);

$dotenv->clear();

dump($_ENV);
dump($_SERVER);


APP_ENV=dev
APP_DEBUG=1

# DATABASE
DB_DRIVER=pdo_mysql
DB_HOST=localhost
DB_USER=root
DB_PASS=root
DB_DATABASE=db

# MAILER
MAILER_DSN=smtp://localhost:25
YOUR_EMAIL=admin@site.ru
*/

require __DIR__.'/views/form.php';
?>

