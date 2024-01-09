<?php
declare(strict_types=1);

namespace Laventure\Component\Security\Permission;

use Laventure\Component\Security\Permission\Contract\Voter;
use Laventure\Component\Security\User\Contract\UserInterface;

/**
 * Permission
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Security\Permission
*/
final class Permission
{

     /**
      * @var Voter[]
     */
     protected array $voters = [];



     /**
      * @param UserInterface $user
      * @param string $permission
      * @param object|null $subject
      * @return bool
     */
     public function can(UserInterface $user, string $permission, ?object $subject = null): bool
     {
          foreach ($this->voters as $voter) {
              if ($voter->canVote($permission, $subject)) {
                  $vote = $voter->vote($user, $permission, $subject);
                  if ($vote === true) {
                      return true;
                  }
              }
          }

          return false;
     }




     /**
      * @param Voter $voter
      *
      * @return $this
     */
     public function addVoter(Voter $voter): Permission
     {
         $this->voters[] = $voter;

         return $this;
     }




     /**
      * @param Voter[] $voters
      *
      * @return $this
     */
     public function addVoters(array $voters): Permission
     {
         foreach ($voters as $voter) {
             $this->addVoter($voter);
         }

         return $this;
     }
}