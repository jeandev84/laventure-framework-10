<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Exception;

use Laventure\Component\Http\Message\Request\Request;
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
     * @var Request
    */
    protected RequestInterface $request;



    /**
     * @param RequestInterface $request
     * @param string $message
     * @param int $code
    */
    public function __construct(RequestInterface $request, string $message, int $code = 0)
    {
        parent::__construct($message, $code);
        $this->request = $request;
    }





    /**
     * @inheritDoc
    */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
