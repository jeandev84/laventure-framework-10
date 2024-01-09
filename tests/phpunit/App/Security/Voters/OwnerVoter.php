<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Security\Voters;

use Laventure\Component\Security\Permission\Contract\Voter;
use Laventure\Component\Security\User\Contract\UserInterface;
use PHPUnitTest\App\Entity\OwnerInterface;

/**
 * OwnerVoter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Security\Voters
*/
class OwnerVoter implements Voter
{

    /**
     * @inheritDoc
    */
    public function canVote(string $permission, ?object $subject = null): bool
    {
         return $subject instanceof OwnerInterface;
    }




    /**
     * @inheritDoc
    */
    public function vote(UserInterface $user, string $permission, ?object $subject = null): bool
    {
        if (! $user instanceof OwnerInterface) {
            throw new \RuntimeException('Given user must be instance of '. OwnerInterface::class);
        }

        if (! $subject instanceof OwnerInterface) {
            throw new \RuntimeException('Given voter must be instance of '. OwnerInterface::class);
        }

        return $user->getId() === $subject->getOwner()->getId();
    }
}