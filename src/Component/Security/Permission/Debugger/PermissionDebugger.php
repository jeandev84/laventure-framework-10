<?php
declare(strict_types=1);

namespace Laventure\Component\Security\Permission\Debugger;


use Laventure\Component\Security\Permission\Contract\Voter;
use Laventure\Component\Security\User\Contract\UserInterface;

/**
 * PermissionDebugger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Security\Permission\Debugger
*/
interface PermissionDebugger
{

    /**
     * @param Voter $voter
     * @param bool $vote
     * @param string $permission
     * @param UserInterface $user
     * @param object|null $subject
     * @return void
     */
     public function debug(Voter $voter, bool $vote, string $permission, UserInterface $user, ?object $subject = null): void;
}