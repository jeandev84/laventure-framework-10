<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Providers;

use Laventure\Component\Container\Provider\ServiceProvider;
use Laventure\Component\Routing\Router;

/**
 * RouterServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Providers
*/
class RouterServiceProvider extends ServiceProvider
{

    const NAMESPACE = 'App\\Controller\\';

    /**
     * @inheritDoc
    */
    public function register(): void
    {
         $this->app->singleton(Router::class, function () {
             return $this->app->make(Router::class, [
                 'namespace' => self::NAMESPACE
             ]);
         });
    }
}