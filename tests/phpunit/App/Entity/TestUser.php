<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

use Laventure\Component\Security\User\Contract\UserInterface;

/**
 * TestUser
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
 */
class TestUser implements UserInterface
{

    /**
     * @inheritDoc
    */
    public function getIdentifier(): string
    {
        return 'test-user@demo.com';
    }



    /**
     * @inheritDoc
    */
    public function getPassword(): ?string
    {
        return '';
    }



    /**
     * @inheritDoc
    */
    public function getRoles(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function getSalt(): ?string
    {
        return '';
    }



    /**
     * @inheritDoc
    */
    public function eraseCredentials(): void
    {

    }
}