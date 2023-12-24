<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;


use CurlHandle;
use Laventure\Component\Http\Client\Request\Exception\CurlException;

/**
 * CurlRequest wrapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class CurlRequest
{
     /**
      * @var CurlHandle|false
     */
     protected $ch;



     /**
      * @var string
     */
     protected string $url;


     /**
      * @var string
     */
     protected string $method = '';


     /**
      * @var null
     */
     protected $body  = null;



     /**
      * @var int
     */
     protected int $statusCode = 0;




     /**
      * @var array
     */
     protected array $headers = [];




     /**
      * @var array
     */
     protected array $options = [];




     /**
      * @param string $url
     */
     public function __construct(string $url)
     {
         $this->ch = curl_init($url);
         $this->setOptions([
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_SSL_VERIFYPEER => false,
             CURLOPT_HEADER         => false
         ]);
     }




     /**
      * @param string $method
      *
      * @return $this
     */
     public function method(string $method): static
     {
         $this->method = $method;

         return $this;
     }





     /**
      * @param $key
      *
      * @param $value
      *
      * @return $this
     */
     public function setOption($key, $value): static
     {
          curl_setopt($this->ch, $key, $value);

          return $this;
     }





     /**
      * @param array $options
      * @return $this
     */
     public function setOptions(array $options): static
     {
         curl_setopt_array($this->ch, $options);

         return $this;
     }





     /**
      * @return bool
      *
      * @throws CurlException
     */
     public function send(): bool
     {
          $this->setAvailableOptions();

          $this->body = (string)curl_exec($this->ch);

          if ($errno = curl_errno($this->ch)) {
               throw new CurlException(curl_error($this->ch), $errno);
          }

          $this->statusCode = (int)$this->getInfo(CURLINFO_HTTP_CODE);

          curl_close($this->ch);

          return true;
     }





    /**
     * @return string
    */
    public function getBody(): string
    {
        return $this->body;
    }



    /**
     * @return int
    */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }



    /**
     * @param $key
     * @return mixed
    */
    public function getInfo($key): mixed
    {
        return curl_getinfo($this->ch, $key);
    }




    private function setAvailableOptions(): void
    {
         //
    }
}