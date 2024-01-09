<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Security\Voters;

use Laventure\Component\Security\Permission\Contract\Voter;
use Laventure\Component\Security\User\Contract\UserInterface;
use PHPUnitTest\App\Entity\Roles;
use PHPUnitTest\App\Entity\User;

/**
 * AdminVoter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Security\Voters
 */
class AdminVoter implements Voter
{

    /**
     * @inheritDoc
    */
    public function canVote(string $permission, ?object $subject = null): bool
    {
        return true;
    }



    /**
     * @inheritDoc
    */
    public function vote(UserInterface $user, string $permission, ?object $subject = null): bool
    {
        return in_array(Roles::ADMIN, $user->getRoles());
    }
}