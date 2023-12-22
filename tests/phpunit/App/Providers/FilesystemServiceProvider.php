<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Providers;

use Laventure\Component\Container\Provider\ServiceProvider;
use PHPUnitTest\App\Services\Filesystem\Filesystem;
use PHPUnitTest\App\Services\Filesystem\FilesystemInterface;

/**
 * FilesystemServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Providers
 */
class FilesystemServiceProvider extends ServiceProvider
{

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singleton(FilesystemInterface::class, Filesystem::class);
    }
}