<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Container;

use Laventure\Component\Container\Concrete\BoundConcrete;
use Laventure\Component\Container\Concrete\SharedConcrete;
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

    public function testBind(): void
    {
        $container = new Container();
        $resolver  = $container->getResolver();
        $router    = new Router();
        $auth      = new Auth();

        $container->bind('name', 'brown');
        $container->bind('auth', $auth);
        $container->bind(Router::class, $router);
        $container->bind();

        $expectedBindings = [
            'name' => new BoundConcrete('name', 'brown', $resolver),
            'auth' => new BoundConcrete('auth', $auth, $resolver),
            Router::class => new BoundConcrete(Router::class, $router, $resolver),
        ];

        $this->assertEquals($expectedBindings, $container->getBindings());
        $this->assertSame('brown', $container->get('name'));
        $this->assertSame($auth, $container->get('auth'));
        $this->assertSame($router, $container->get(Router::class));
    }



    public function testSingleton(): void
    {
        $container = new Container();
        $resolver  = $container->getResolver();

        $func = function () {
            return new Router("PHPUnitTest\App\Controllers");
        };

        $container->singleton(Router::class, $func);

        $expected = [
            Router::class => new SharedConcrete(Router::class, $func, $resolver),
        ];

        $this->assertEquals($expected, $container->getBindings());
    }
}
