<?php
namespace PHPUnitTest\Component\Dotenv;

use Laventure\Component\Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * DotenvTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Dotenv
 */
class DotenvTest extends TestCase
{
     public function testLoadEnvironments()
     {
          $dotenv = new Dotenv(__DIR__.'/config');
          $dotenv->load();

          $config1 = [
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

         $expected1 = [
             "app.mode" => "dev",
             "app.debug" => "1",
             "db" => [
                 "driver" => "pdo_mysql",
                 "host" => "localhost",
                 "username" => "root",
                 "password" => "root",
                 "name" => "db"
             ]
         ];

         $expected2 = [
             'APP_ENV'     => 'dev',
             'APP_DEBUG'   => '1',
             'DB_DRIVER'   => 'pdo_mysql',
             'DB_HOST'     => 'localhost',
             'DB_USER'     => 'root',
             'DB_PASS'     => 'root',
             'DB_DATABASE' => 'db',
             'MAILER_DSN'  => 'smtp://localhost:25',
             'YOUR_EMAIL'  => 'admin@site.ru'
         ];

         $this->assertSame($expected1, $config1);
         $this->assertSame($expected2, $_ENV);
     }
}
