<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

/**
 * User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
 */
class User
{

     public function __construct(protected int $id, protected string $username)
     {

     }

    public function getId(): int
     {
         return $this->id;
     }


     public function getUsername(): string
     {
         return $this->username;
     }
}