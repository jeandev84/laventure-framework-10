<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Entity;


use Laventure\Component\Security\User\Contract\UserInterface;

/**
 * OwnerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
 */
interface OwnerInterface extends UserInterface
{
      public function getId(): ?int;

      public function getOwner(): OwnerInterface;
}