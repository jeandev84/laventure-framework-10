<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client;

use Laventure\Component\Http\Client\Service\ClientServiceInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Client
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client
*/
class Client implements ClientInterface
{

    public function __construct(
        protected ClientServiceInterface $service,
        protected array $options = []
    )
    {
    }


    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->service->sendRequest(
                 $request->getMethod(),
                 (string)$request->getUri(),
                 $this->options
        );
    }
}