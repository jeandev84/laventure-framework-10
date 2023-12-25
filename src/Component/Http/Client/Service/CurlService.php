<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;


use CurlHandle;
use Laventure\Component\Http\Client\Response\Contract\ClientResponseInterface;
use Laventure\Component\Http\Client\Service\Common\ClientService;
use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
use Laventure\Component\Http\Client\Service\Exception\CurlException;
use Laventure\Component\Http\Client\Service\Options\AuthBasicOptions;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOption;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOptionInterface;

/**
 * CurlRequest wrapper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class CurlService extends ClientService
{


     /**
      * @var CurlHandle|false
     */
     protected $ch;




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
      * @param $key
      * @param $value
      * @return $this
     */
     public function setOption($key, $value): static
     {
          curl_setopt($this->ch, $key, $value);

          return $this;
     }




     /**
      * @param array $options
      *
      * @return $this
     */
     public function setOptions(array $options): static
     {
         curl_setopt_array($this->ch, $options);

         return $this;
     }




    /**
     * @inheritDoc
    */
    public function proxy(string $proxy): static
    {
         return $this;
    }




    /**
     * @inheritDoc
    */
    public function authBasic(AuthBasicOptions $options): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function oAuth(string $accessToken): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function headers(array $headers): static
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this->setOption(CURLOPT_HTTPHEADER, $this->headers);
    }





    /**
     * @param array|string $body
     * @return $this
    */
    public function body(array|string $body): static
    {
        if (is_array($body)) {
            $body = $this->buildQueryParams($body, '', '&');
        }

        $this->body = $body;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function json(array|string $body): static
    {
        $this->headers(['Content-Type' => 'application/json; charset=UTF-8']);
        $this->body = (is_array($body) ? $this->encodeJson($body) : $body);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function files(array $files): static
    {
         return $this;
    }





    /**
     * @inheritDoc
    */
    public function cookies(array $cookies): static
    {
        return $this;
    }





    /**
     * @inheritDoc
     */
    public function upload($file): static
    {
        return $this;
    }



    /**
     * @inheritDoc
    */
    public function download($file): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function send(): ClientResponseInterface
    {

    }




    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }
}