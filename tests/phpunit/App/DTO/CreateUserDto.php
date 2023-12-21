<?php
declare(strict_types=1);

namespace PHPUnitTest\App\DTO;

/**
 * CreateUserDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\DTO
 */
class CreateUserDto
{
   public function __construct(
       public int $id,
       public string $username
   )
   {
   }
}