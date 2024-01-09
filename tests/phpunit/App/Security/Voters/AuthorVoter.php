<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Security\Voters;

use Laventure\Component\Security\Permission\Contract\Voter;
use Laventure\Component\Security\User\Contract\UserInterface;
use PHPUnitTest\App\Entity\TestPost;

/**
 * AuthorVoter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Security\Voters
 */
class AuthorVoter implements Voter
{

    const EDIT = 'edit_post';


    /**
     * @inheritDoc
    */
    public function canVote(string $permission, ?object $subject = null): bool
    {
       return $permission === self::EDIT && $subject instanceof TestPost;
    }



    /**
     * @inheritDoc
    */
    public function vote(UserInterface $user, string $permission, ?object $subject = null): bool
    {
        if (! $subject instanceof TestPost) {
             throw new \RuntimeException('subject must be instance of '. TestPost::class);
        }

        // Needs verify ids equals
        return $subject->getAuthor() === $user;
    }
}