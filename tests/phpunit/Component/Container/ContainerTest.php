<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Container;

use Laventure\Component\Container\Concrete\BoundConcrete;
use Laventure\Component\Container\Container;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Router;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Services\Auth\Auth;


/**
 * ContainerTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Container
 *
 * // TODO Refactoring
*/
class ContainerTest extends TestCase
{

    public function testBindings()
    {
        $container = new Container();
        $router    = new Router();
        $auth      = new Auth();

        $container->bind('name', 'brown');
        $container->bind('auth', $auth);
        $container->bind(Router::class, $router);

        $expected = [
            'name' => new BoundConcrete('name', 'brown'),
            'auth' => new BoundConcrete('auth', $auth),
            Router::class => new BoundConcrete(Router::class, $router),
        ];

        $this->assertEquals($expected, $container->getBindings());
    }
}
