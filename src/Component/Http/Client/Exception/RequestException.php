<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Exception;


use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;

/**
 * RequestException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Exception
*/
class RequestException extends ClientException implements RequestExceptionInterface
{

    /**
     * @inheritDoc
    */
    public function getRequest(): RequestInterface
    {
        // TODO: Implement getRequest() method.
    }
}