<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Services\Auth;

use PHPUnitTest\App\Entity\User;

/**
 * Auth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Services\Auth
 */
class Auth
{
     public function attempt(string $username, string $password, bool $rememberMe = false)
     {
         return true;
     }


     public function user(): User
     {
         return new User(1, 'john@doe.com');
     }
}