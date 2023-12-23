<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;


use Psr\Http\Message\StreamInterface;

/**
 * JsonResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
*/
class JsonResponse extends Response
{

     /**
      * @param array|object $data
      *
      * @param int $status
      *
      * @param array $headers
     */
     public function __construct(array|object $data, int $status = 200, array $headers = [])
     {
         parent::__construct($status, ['Content-Type' => 'application/json; charset=UTF-8']);
         $this->body->write(json_encode($data));
         $this->headers->add($headers);
     }
}