<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Factory;


use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * ResponseFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Factory
 */
class ResponseFactory implements ResponseFactoryInterface
{

    /**
     * @inheritDoc
    */
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
         $response = new Response();
         $response->withStatus($code, $reasonPhrase);
         return $response;
    }
}