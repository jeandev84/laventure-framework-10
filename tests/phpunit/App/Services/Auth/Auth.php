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
     protected $user = null;


     public function attempt(string $username, string $password, bool $rememberMe = false): bool
     {
         $hash = password_hash($username, PASSWORD_DEFAULT);

         if (! password_verify($password, $hash)) {
              return false;
         }

         $this->user = new User(random_int(1, 100), $username);

         return true;
     }


     public function user(): User
     {
         if ($this->user) {
             return $this->user;
         }

         return new User(random_int(1, 100), uniqid(md5('someone')));
     }
}