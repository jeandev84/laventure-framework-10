<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;


use Psr\Http\Message\ResponseInterface;

/**
 * ClientServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\StreamClient\Service\Contract
*/
interface ClientServiceInterface
{
      /**
       * @param string $method
       *
       * @return $this
      */
      public function method(string $method): static;



      /**
       * @param string $url
       *
       * @return $this
      */
      public function url(string $url): static;





      /**
       * @param array $options
       *
       * @return $this
      */
      public function options(array $options): static;






      /**
       * @return ResponseInterface
      */
      public function send(): ResponseInterface;
}