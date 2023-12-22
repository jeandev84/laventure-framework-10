<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Container;

use Laventure\Component\Container\Concrete\BoundConcrete;
use Laventure\Component\Container\Concrete\SharedConcrete;
use Laventure\Component\Container\Container;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Router;
use Laventure\Component\Routing\RouterInterface;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Services\Auth\Auth;
use PHPUnitTest\App\Services\FooService;
use PHPUnitTest\App\Services\User\UserService;


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

//    public function testBind(): void
//    {
//        $container = new Container();
//        $router    = new Router();
//        $auth      = new Auth();
//        $func      = function () use ($auth) {
//            return new UserService($auth);
//        };
//
//        $container->bind('name', 'brown');
//        $container->bind('auth', $auth);
//        $container->bind(Router::class, $router);
//        $container->bind(UserService::class, $func);
//
//        $expectedBindings = [
//            'name' => new BoundConcrete('name', 'brown'),
//            'auth' => new BoundConcrete('auth', $auth),
//            Router::class => new BoundConcrete(Router::class, $router),
//            UserService::class => new BoundConcrete(UserService::class, $func)
//        ];
//
//        $this->assertEquals($expectedBindings, $container->getBindings());
//        $this->assertSame('brown', $container->get('name'));
//        $this->assertInstanceOf(Auth::class, $container->get('auth'));
//        $this->assertInstanceOf(Router::class, $container->get(Router::class));
//        $this->assertInstanceOf(UserService::class, $container->get(UserService::class));
//    }
//
//
//
//    public function testSingleton(): void
//    {
//        $container = new Container();
//        $func = function () {
//            return new Router("PHPUnitTest\App\Controllers");
//        };
//
//        $container->singleton(Router::class, $func);
//
//        $expected = [
//            Router::class => new SharedConcrete(Router::class, $func),
//        ];
//
//        $this->assertEquals($expected, $container->getBindings());
//    }




//    public function testResolvedId()
//    {
//        $container = Container::getInstance();
//        $container->bind('name', 'jean');
//        $container->singleton(Container::class, $container);
//        $container->singleton(RouterInterface::class, Router::class);
//
//        dd($container->get(RouterInterface::class));
//
//        $this->assertSame('jean', $container->get('name'));
//        $this->assertSame($container, $container->get(Container::class));
//        $this->assertInstanceOf(Router::class, $container->get(RouterInterface::class));
//    }
}
