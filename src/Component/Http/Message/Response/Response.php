<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\MessageTrait;
use Laventure\Component\Http\Message\Request\Body\RequestBody;
use Laventure\Component\Http\Message\Response\Body\ResponseBody;
use Laventure\Component\Http\Message\Response\Headers\ResponseHeaders;
use Laventure\Component\Http\Message\Stream\ValueObject\StreamResource;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Response
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
 */
class Response implements ResponseInterface
{

     use MessageTrait;



     /**
      * @var int
     */
     protected int $status;



     /**
      * @var string
     */
     protected string $reasonPhrase = '';


     /**
      * @param int $status
      *
      * @param array $headers
      *
      * @param StreamInterface|null $body
     */
     public function __construct(int $status = 200, array $headers = [], StreamInterface $body = null)
     {
          $this->status  = $status;
          $this->headers = new ResponseHeaders($headers);
          $this->body    = ($body ?: new ResponseBody());
     }





     /**
      * @inheritDoc
     */
     public function getStatusCode(): int
     {
         return $this->status;
     }





     /**
      * @inheritDoc
     */
     public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
     {
          $this->status       = $code;
          $this->reasonPhrase = $reasonPhrase;

          return $this;
     }





     /**
      * @inheritDoc
     */
     public function getReasonPhrase(): string
     {
         return $this->reasonPhrase;
     }




     public function send(): void
     {
          http_response_code($this->status);
     }




     /**
      * @return string
     */
     public function __toString(): string
     {
          return (string)$this->body;
     }
}