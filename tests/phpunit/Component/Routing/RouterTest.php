<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Routing;

use Laventure\Component\Routing\Router;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\Component\Routing\Middlewares\AuthenticatedMiddleware;
use PHPUnitTest\Component\Routing\Middlewares\GuestMiddleware;


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
            $router->route('GET', '/', ['SiteController', 'index'], 'home'),
            $router->route('GET', '/about', ['SiteController', 'about'], 'about'),
            $router->route('GET|POST', '/contact-us', ['SiteController', 'contactUs'], 'contact.us'),
            $router->route('PUT', '/books/{id}', ['BookController', 'update'], 'books.update'),
         ];

         $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodGet(): void
    {
        $router = new Router();
        $router->get( '/', ['SiteController', 'index'], 'home');

        $expected = [
            $router->route('GET', '/', ['SiteController', 'index'], 'home'),
        ];

        $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodPost(): void
    {
        $router = new Router();
        $router->post('/contact-us', ['SiteController', 'contactUs'], 'contact.us');

        $expected = [
            $router->route('POST', '/contact-us', ['SiteController', 'contactUs'], 'contact.us'),
        ];

        $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodPut(): void
    {
        $router = new Router();
        $router->map('PUT', '/books/{id}', ['BookController', 'update'], 'books.update');

        $expected = [
            $router->route('PUT', '/books/{id}', ['BookController', 'update'], 'books.update'),
        ];

        $this->assertEquals($expected, $router->getRoutes());
    }



    public function testMapRouteByMethodDelete(): void
    {
        $router = new Router();
        $router->delete('/books/{id}', ['BookController', 'delete'], 'books.delete');

        $expected = [
            $router->route('DELETE', '/books/{id}', ['BookController', 'delete'], 'books.delete'),
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

        $expected = $router->route('GET', '/welcome', function () {
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


        $expected1 = $router->route('GET', '/admin/books/{slug}-{id}', function () {
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


        $expected1 = $router->route('GET', '/users/{id}', function () {
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


        $expected2 = $router->route('DELETE', '/books/{slug}/{id?}', function () {
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
}
