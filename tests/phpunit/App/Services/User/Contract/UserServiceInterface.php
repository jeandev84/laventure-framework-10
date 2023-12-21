<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Services\User\Contract;


use PHPUnitTest\App\Entity\User;
use PHPUnitTest\App\Http\CreateUserFormRequest;

/**
 * UserServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Services\User\Contract
 */
interface UserServiceInterface
{
    public function createUser(CreateUserFormRequest $request): User;


    public function loginUser(): User;
}