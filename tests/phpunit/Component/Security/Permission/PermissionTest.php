<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Security\Permission;

use Laventure\Component\Security\Permission\Permission;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Entity\TestUser;
use PHPUnitTest\App\Security\Voters\AlwaysNoVoter;
use PHPUnitTest\App\Security\Voters\AlwaysYesVoter;

/**
 * PermissionTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Security\Permission
 *
 * ./vendor/bin/phpunit-watcher watch --color tests
 */
class PermissionTest extends TestCase
{
     public function testEmptyVoters(): void
     {
         $permission = new Permission();
         $user       = new TestUser();
         $this->assertFalse($permission->can($user, 'demo'));
     }



     public function testWithTrueVoter(): void
     {
         $permission = new Permission();
         $user       = new TestUser();
         $permission->addVoter(new AlwaysYesVoter());
         $this->assertTrue($permission->can($user, 'demo'));
     }



    public function testWithOneVoterVotesTrue(): void
    {
        $permission = new Permission();
        $user       = new TestUser();
        $permission->addVoter(new AlwaysYesVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $this->assertTrue($permission->can($user, 'demo'));
    }
}
