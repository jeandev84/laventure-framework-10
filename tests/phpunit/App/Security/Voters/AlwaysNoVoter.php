<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Security\Voters;

use Laventure\Component\Security\Permission\Contract\Voter;
use Laventure\Component\Security\User\Contract\UserInterface;

/**
 * AlwaysNoVoter (or rename to AlwaysHasNotVoter)
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Security\Voters
*/
class AlwaysNoVoter implements Voter
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
        return false;
    }
}