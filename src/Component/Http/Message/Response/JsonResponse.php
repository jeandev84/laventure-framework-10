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
      * @var array|object
     */
     protected array|object $data;



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
         $this->headers->add($headers);
         $this->data = $data;
     }






     /**
      * @return string
     */
     public function __toString(): string
     {
         $this->setContent($this->encode($this->data));

         return (string)$this->body;
     }





    /**
     * @param array|object $data
     *
     * @return false|string
    */
    private function encode(array|object $data): bool|string
    {
        $content = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

        if (json_last_error()) {
            trigger_error(json_last_error_msg());
        }

        return $content;
    }
}