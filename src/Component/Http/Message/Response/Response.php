<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\MessageTrait;
use Laventure\Component\Http\Message\Request\Body\RequestBody;
use Laventure\Component\Http\Message\Response\Body\ResponseBody;
use Laventure\Component\Http\Message\Response\Headers\ResponseHeaders;
use Psr\Http\Message\ResponseInterface;

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
      * @param int $status
      *
      * @param array $headers
     */
     public function __construct(int $status = 200, array $headers = [])
     {
          $this->body    = new ResponseBody();
          $this->headers = new ResponseHeaders($headers);
     }




     /**
      * @inheritDoc
     */
     public function getStatusCode(): int
     {
         return 200;
     }





     /**
      * @inheritDoc
     */
     public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
     {
          return $this;
     }





     /**
      * @inheritDoc
     */
     public function getReasonPhrase(): string
     {
         return '';
     }




     public function send(): void
     {

     }




     /**
      * @return string
     */
     public function __toString(): string
     {
          return (string)$this->body;
     }
}
