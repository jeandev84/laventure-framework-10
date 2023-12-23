<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Factory;


use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Request\ServerRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

/**
 * RequestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Factory
*/
class RequestFactory implements RequestFactoryInterface
{

    /**
     * @inheritDoc
    */
    public function createRequest(string $method, $uri): RequestInterface
    {
         return new Request($method, $uri);
    }





    /**
     * @param string $method
     * @param $uri
     * @return RequestInterface
    */
    public static function create(string $method, $uri): RequestInterface
    {
         return new Request($method, $uri);
    }
}