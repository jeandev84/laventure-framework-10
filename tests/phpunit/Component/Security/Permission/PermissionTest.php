<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Security\Permission;

use Laventure\Component\Security\Permission\Contract\Voter;
use Laventure\Component\Security\Permission\Debugger\ConsoleDebugger;
use Laventure\Component\Security\Permission\Debugger\PermissionDebugger;
use Laventure\Component\Security\Permission\Permission;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Entity\TestPost;
use PHPUnitTest\App\Entity\TestUser;
use PHPUnitTest\App\Security\Voters\AlwaysNoVoter;
use PHPUnitTest\App\Security\Voters\AlwaysYesVoter;
use PHPUnitTest\App\Security\Voters\AuthorVoter;
use PHPUnitTest\App\Security\Voters\SpecificVoter;

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
 * ./vendor/bin/phpunit-watcher watch --color tests/phpunit/Component/Security/Permission/PermissionTest.php
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


    public function testWithSpecificPermissionVoter(): void
    {
        $permission = new Permission();
        $user       = new TestUser();
        $permission->addVoter(new SpecificVoter());
        $this->assertFalse($permission->can($user, 'demo'));
        $this->assertTrue($permission->can($user, SpecificVoter::SPECIFIC));
    }



    public function testWithSpecificConditionVoter(): void
    {
        $permission = new Permission();
        $user1      = new TestUser();
        $user2      = new TestUser();
        $post       = new TestPost($user1);
        $permission->addVoter(new AuthorVoter());

        $this->assertTrue($permission->can($user1, AuthorVoter::EDIT, $post));
        $this->assertFalse($permission->can($user2, AuthorVoter::EDIT, $post));
    }



    public function testDebug(): void
    {
        $debugger   = $this->getMockBuilder(PermissionDebugger::class)->getMock();
        $debugger->expects($this->exactly(5))->method('debug');

        $permission = new Permission($debugger);
        $user       = new TestUser();
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysYesVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->can($user, Voter::EDIT);
    }



    /*
    public function testConsoleDebug(): void
    {
        $permission = new Permission(new ConsoleDebugger());
        $user       = new TestUser();
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->addVoter(new AlwaysYesVoter());
        $permission->addVoter(new AlwaysNoVoter());
        $permission->can($user, Voter::EDIT);
    }
    */
}
