<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;


use CurlHandle;
use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
use Laventure\Component\Http\Client\Service\Exception\CurlException;

/**
 * CurlRequest wrapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class CurlService implements ClientServiceInterface
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
     private array $defaultOptions = [
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_SSL_VERIFYPEER => false,
         CURLOPT_HEADER         => false
     ];



     public function __construct()
     {
         $this->ch = curl_init();
         $this->setOptions($this->defaultOptions);
     }






    /**
     * @inheritDoc
    */
    public function url(string $path): static
    {
          $this->setOption(CURLOPT_URL, $path);

          return $this;
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

    



    /**
     * @inheritDoc
    */
    public function getInfos(): array
    {
        return curl_getinfo($this->ch);
    }

    
    



    /**
     * @inheritDoc
    */
    public function getHeaders(): array
    {
         return [];
    }





    private function setAvailableOptions(): void
    {

    }
}