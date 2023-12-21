<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Controllers\Auth;

use PHPUnitTest\App\Services\Auth\Auth;

/**
 * AuthController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Controllers\Auth
 */
class AuthController
{
      /**
       * @param Auth $auth
      */
      public function __construct(protected Auth $auth)
      {

      }



      public function index(): string
      {
          $authenticated = $this->auth->attempt('john@doe.com', '12345');

          return $authenticated ? 'authenticated': 'not authenticated';
      }
}