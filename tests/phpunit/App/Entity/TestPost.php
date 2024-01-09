<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

use Laventure\Component\Security\User\Contract\UserInterface;

/**
 * TestPost
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
 */
class TestPost
{

    protected UserInterface $user;


    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }



    public function getAuthor(): UserInterface
    {
        return $this->user;
    }
}