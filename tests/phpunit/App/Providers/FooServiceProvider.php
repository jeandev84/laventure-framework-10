<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Providers;

use Laventure\Component\Container\Provider\ServiceProvider;
use PHPUnitTest\App\Services\FooService;

/**
 * FooServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Providers
 */
class FooServiceProvider extends ServiceProvider
{

    /**
     * @inheritDoc
    */
    public function register(): void
    {
          $this->app->instance(FooService::class, FooService::class);
    }
}