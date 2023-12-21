<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing;

use Laventure\Component\Routing\Router;
use Laventure\Component\Routing\RouterInterface;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Controllers\Admin\UserController;
use PHPUnitTest\App\Controllers\HomeController;
use PHPUnitTest\App\Middlewares\AuthenticatedMiddleware;


/**
 * RouterTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Routing
 *
 * // TODO Refactoring
*/
class RouterTest extends TestCase
{

    const NAMESPACE = 'PHPUnitTest\\App\\Controllers';



    public function testThereAreNoRoutesWhenRouterIsCreated(): void
    {
        $this->assertEmpty((new Router())->getRoutes());
    }



    public function testMethodMap(): void
    {
         $router = new Router();
         $router->map('GET', '/', ['SiteController', 'index'], 'home');
         $router->map('GET', '/about', ['SiteController', 'about'], 'about');
         $router->map('GET|POST', '/contact-us', ['SiteController', 'contactUs'], 'contact.us');
         $router->map('PUT', '/books/{id}', ['BookController', 'update'], 'books.update');

         $expected = [
            $router->makeRoute('GET', '/', ['SiteController', 'index'], 'home'),
            $router->makeRoute('GET', '/about', ['SiteController', 'about'], 'about'),
            $router->makeRoute('GET|POST', '/contact-us', ['SiteController', 'contactUs'], 'contact.us'),
            $router->makeRoute('PUT', '/books/{id}', ['BookController', 'update'], 'books.update'),
         ];

         $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodGet(): void
    {
        $router = new Router();
        $router->get( '/', ['SiteController', 'index'], 'home');

        $expected = [
            $router->makeRoute('GET', '/', ['SiteController', 'index'], 'home'),
        ];

        $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodPost(): void
    {
        $router = new Router();
        $router->post('/contact-us', ['SiteController', 'contactUs'], 'contact.us');

        $expected = [
            $router->makeRoute('POST', '/contact-us', ['SiteController', 'contactUs'], 'contact.us'),
        ];

        $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodPut(): void
    {
        $router = new Router();
        $router->map('PUT', '/books/{id}', ['BookController', 'update'], 'books.update');

        $expected = [
            $router->makeRoute('PUT', '/books/{id}', ['BookController', 'update'], 'books.update'),
        ];

        $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodDelete(): void
    {
        $router = new Router();
        $router->delete('/books/{id}', ['BookController', 'delete'], 'books.delete');

        $expected = [
            $router->makeRoute('DELETE', '/books/{id}', ['BookController', 'delete'], 'books.delete'),
        ];

        $this->assertEquals($expected, $router->getRoutes());
    }





    /**
     * @return void
    */
    public function testRouteMatch()
    {
        $router = new Router();

        $router->get('/welcome', function () {
            return "Welcome";
        });

        $expected = $router->makeRoute('GET', '/welcome', function () {
            return "Welcome";
        })->options(['uri' => '/welcome']);

        $this->assertEquals($expected, $router->match('GET', '/welcome'));
    }




    public function testRouteMatchWithQueryString()
    {
        $router = new Router();

        /*
        $router->get('/', function () {
            return "Welcome";
        }, 'welcome')
        ->middleware(GuestMiddleware::class);
        */


        $router->get('/admin/books/{slug}-{id}', function () {
            return "Get Book from storage";
        }, 'books.show')
        ->slug('slug')->id()
        ->middlewares([
            AuthenticatedMiddleware::class
        ]);


        $expected1 = $router->makeRoute('GET', '/admin/books/{slug}-{id}', function () {
            return "Get Book from storage";
        }, 'books.show')
        ->slug('slug')->id()
        ->params(['slug' => 'my-new-book', 'id' => 1])
        ->middlewares([
            AuthenticatedMiddleware::class
        ])
        ->pattern('/admin/books/(?P<slug>[a-z\-0-9]+)-(?P<id>\d+)')
        ->options(['uri' => '/admin/books/my-new-book-1?page=3&sort=users.id&direction=asc']);

        $this->assertEquals($expected1, $router->match('GET', '/admin/books/my-new-book-1?page=3&sort=users.id&direction=asc'));
    }




    /**
     * @return void
     */
    public function testRouteNotMatch(): void
    {
        $router = new Router();

        $router->get('/welcome', function () {
            return "Welcome";
        });


        $this->assertFalse($router->match('GET', '/foo'));
    }



    /**
     * @return void
     */
    public function testRouteMatchWithRequireParam(): void
    {
        $router = new Router();

        $router->get('/users/{id}', function () {
            return "Users";
        })->where('id', '\d+');


        $expected1 = $router->makeRoute('GET', '/users/{id}', function () {
            return "Get Users";
        })
        ->where('id', '\d+')
        ->params(['id' => 3])
        ->options(['uri' => '/users/3']);



        $router->put('/books/{id}', function () {
            return "Update Books";
        })->where('id', '\d+');


        $router->delete('/books/{slug}/{id?}', function () {
            return "Delete Books";
        })->slug('slug')->id();


        $expected2 = $router->makeRoute('DELETE', '/books/{slug}/{id?}', function () {
            return "Delete Books";
        })
        ->slug('slug')->id()
        ->params(['slug' => 'my-new-book'])
        ->options(['uri' => '/books/my-new-book']);


        $this->assertEquals($expected1, $router->match('GET', '/users/3'));
        $this->assertFalse($router->match('PUT', '/books'));
        $this->assertEquals($expected2, $router->match('DELETE', '/books/my-new-book'));
    }




    /**
     * @return void
     */
    public function testGenerateURI(): void
    {
        $router = new Router();

        $router->delete('/books/{slug}/{id?}', function () {
            return "Delete Books";
        }, 'books.delete')->slug('slug')->id();


        $this->assertSame(
    '/books/un-nouveau-article/',
            $router->generate('books.delete', ['slug' => 'un-nouveau-article', 'id' => null])
        );

        $this->assertSame(
            '/books/un-nouveau-article/3',
            $router->generate('books.delete', ['slug' => 'un-nouveau-article', 'id' => 3])
        );
    }



    public function testIfRouteGroupMapEverythingCorrectly(): void
    {
         $router = new \Laventure\Component\Routing\Router();

         $prefixes = [
            'path' => 'admin/',
            'namespace' => 'Admin\\',
            'name' => 'admin.',
            'middlewares' => [AuthenticatedMiddleware::class]
         ];

         $router->group($prefixes, function (RouterInterface $router) {
            $router->get('/users', [UserController::class, 'index'], 'users.index');
            $router->get('/users/{id}', [UserController::class, 'show'], 'users.show');
            $router->post('/users', [UserController::class, 'store'], 'users.store');
            $router->put('/users/{id}', [UserController::class, 'update'], 'users.update');
            $router->delete('/users/{id}', [UserController::class], 'users.delete');
         });

         $router->get('/welcome', [HomeController::class, 'index'], 'welcome');


         $expectedGroup = [
            $router->makeRoute('GET', '/admin/users', [UserController::class, 'index'], 'admin.users.index'),
            $router->makeRoute('GET', '/admin/users/{id}', [UserController::class, 'show'], 'admin.users.show'),
            $router->makeRoute('POST', '/admin/users', [UserController::class, 'store'], 'admin.users.store'),
            $router->makeRoute('PUT', '/admin/users/{id}', [UserController::class, 'update'], 'admin.users.update'),
            $router->makeRoute('DELETE', '/admin/users/{id}', [UserController::class], 'admin.users.delete'),
            $router->makeRoute('GET', '/welcome', [HomeController::class, 'index'], 'welcome'),
        ];

        $this->assertEquals($expectedGroup, $router->getRoutes());
    }




    public function testIfActionStringMappedCorrectly(): void
    {
        $router = new \Laventure\Component\Routing\Router(static::NAMESPACE);

        $prefixes = [
            'path' => 'admin/',
            'namespace' => 'Admin\\',
            'name' => 'admin.',
            'middlewares' => [AuthenticatedMiddleware::class]
        ];

        $router->group($prefixes, function (RouterInterface $router) {
            $router->get('/users', 'UserController@index', 'users.index');
            $router->get('/users/{id}', 'UserController@show', 'users.show');
            $router->post('/users', 'UserController@store', 'users.store');
            $router->put('/users/{id}', 'UserController@update', 'users.update');
            $router->delete('/users/{id}', 'UserController@delete', 'users.delete');
        });


        $router->get('/welcome', 'HomeController@index', 'welcome');

        $expected = [
            $router->makeRoute('GET', '/admin/users', 'Admin\\UserController@index', 'admin.users.index'),
            $router->makeRoute('GET', '/admin/users/{id}', 'Admin\\UserController@show', 'admin.users.show'),
            $router->makeRoute('POST', '/admin/users', 'Admin\\UserController@store', 'admin.users.store'),
            $router->makeRoute('PUT', '/admin/users/{id}', 'Admin\\UserController@update', 'admin.users.update'),
            $router->makeRoute('DELETE', '/admin/users/{id}', 'Admin\\UserController@delete', 'admin.users.delete'),
            $router->makeRoute('GET', '/welcome', 'HomeController@index', 'welcome'),
        ];


        $this->assertEquals($expected, $router->getRoutes());
    }
}
