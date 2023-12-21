<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Services\User;

use PHPUnitTest\App\DTO\CreateUserDtoFactory;
use PHPUnitTest\App\Entity\User;
use PHPUnitTest\App\Http\CreateUserFormRequest;

/**
 * UserService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Services\User
 */
class UserService
{
     public function createUser(CreateUserFormRequest $request): User
     {
         $dto = CreateUserDtoFactory::fromRequest($request);

         return new User($dto->id, $dto->username);
     }
}