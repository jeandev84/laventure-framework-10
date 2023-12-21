<?php
declare(strict_types=1);

namespace PHPUnitTest\App\DTO;

use PHPUnitTest\App\Http\CreateUserFormRequest;
use PHPUnitTest\App\Http\ParameterBag;

/**
 * CreateUserDtoFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\DTO
 */
class CreateUserDtoFactory
{
     public static function fromArray(array $data): CreateUserDto
     {
         $parameter = new ParameterBag($data);

         return new CreateUserDto(
             (int)$parameter->get('id'),
             (string)$parameter->get('username')
         );
     }


     public static function fromRequest(CreateUserFormRequest $request): CreateUserDto
     {
         return new CreateUserDto($request->getId(), $request->getUsername());
     }
}