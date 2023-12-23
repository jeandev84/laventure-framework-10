<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Factory;


use Laventure\Component\Http\Message\Request\Uri;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

/**
 * UriFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Factory
 */
class UriFactory implements UriFactoryInterface
{

    /**
     * @inheritDoc
    */
    public function createUri(string $uri = ''): UriInterface
    {
         return new Uri($uri);
    }
}