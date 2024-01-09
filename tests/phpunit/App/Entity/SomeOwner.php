<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

/**
 * SomeOwner
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
 */
class SomeOwner implements OwnerInterface
{

    public function getId(): ?int
    {
        // TODO: Implement getId() method.
    }

    public function getOwner(): OwnerInterface
    {
        // TODO: Implement getOwner() method.
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier(): string
    {
        // TODO: Implement getIdentifier() method.
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): ?string
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * @inheritDoc
     */
    public function getSalt(): ?string
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }
}