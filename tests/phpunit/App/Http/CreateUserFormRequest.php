<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http;

/**
 * CreateUserFormRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http
 */
class CreateUserFormRequest
{
     public function getId(): int
     {
         return 3;
     }


     public function getUsername(): string
     {
         return 'someone@site.ru';
     }
}