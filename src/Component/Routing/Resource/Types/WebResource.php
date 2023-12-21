<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Resource\Types;

use Laventure\Component\Routing\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Resource\Resource;
use Laventure\Component\Routing\RouterInterface;

/**
 * WebResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Resource\Types
 */
class WebResource extends Resource
{
    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        return ResourceType::WEB;
    }




    /**
     * @inheritDoc
    */
    public function map(RouterInterface $router): static
    {
        $router->get($this->path(), $this->action('index'), $this->name('index'));
        $router->get($this->path('/{id}'), $this->action('show'), $this->name('show'));
        $router->get($this->path(), $this->action('create'), $this->name('create'));
        $router->post($this->path(), $this->action('store'), $this->name('store'));
        $router->map('PUT|PATCH', $this->path('/{id}'), $this->action('update'), $this->name('update'));
        $router->delete($this->path('/{id}'), $this->action('destroy'), $this->name('destroy'));

        return $this;
    }
}
