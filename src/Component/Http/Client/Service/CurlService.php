<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;


use CurlHandle;
use Laventure\Component\Http\Client\Service\Common\ClientService;
use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
use Laventure\Component\Http\Client\Service\Exception\CurlException;
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




     /**
      * @param ClientServiceOptionInterface|null $options
     */
     public function __construct(ClientServiceOptionInterface $options = null)
     {
           $this->ch = curl_init();
           $this->initializeOptions();

           parent::__construct($options);
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
      * @inheritdoc
      *
      * @throws CurlException
     */
     public function send(): bool
     {
          $this->terminateOptions();

          $this->body((string)$this->exec());

          if ($errno = $this->errno()) {
               throw new CurlException($this->error(), $errno);
          }

          $this->statusCode((int)$this->getInfo(CURLINFO_HTTP_CODE));
          curl_close($this->ch);
          return true;
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
         $this->setOptions([CURLOPT_HEADER => true, CURLOPT_NOBODY => true]);
         $response = $this->exec();
         $headerRows = explode(PHP_EOL, $response);
         $headerRows = array_filter($headerRows, 'trim');

         return $this->filterHeaders($headerRows);
    }






    /**
     * @return void
     */
    private function initializeOptions(): void
    {
        $this->setOptions($this->defaultOptions);
    }





    private function terminateOptions(): void
    {
        $this->setUriOption();
        $this->setOverrideMethods();
        $this->setRequestBody();
    }






    /**
     * @return string
    */
    private function getParsedBody(): string
    {
         $body = $this->options->getBody();

         if ($body && is_array($body)) {
             $body = $this->buildQueryParams($body, '', '&');
         }

         if ($json = $this->options->getJson()) {
             $this->setHeaders(['Content-Type:application/json; charset=UTF-8']);
             $body = $json;
         }

         return $body;
    }





    /**
     * @return void
    */
    private function setRequestBody(): void
    {
        $body = $this->getParsedBody();

        if (in_array($this->method, ['POST', 'PUT', 'PATCH'])) {
            if ($this->isMethod('POST')) {
                $this->setOption(CURLOPT_POST, 1);
            }
            $this->setOption(CURLOPT_POSTFIELDS, $body);
        }
    }




    private function setUriOption(): void
    {
        $this->setOption(CURLOPT_URL, $this->getUri());
    }





    /**
     * @param string $method
     *
     * @return bool
    */
    private function isMethod(string $method): bool
    {
        return strtoupper($this->method) === strtoupper($method);
    }




    /**
     * @return void
    */
    private function setOverrideMethods(): void
    {
        if ($this->hasOverrideMethods()) {
            $this->setOption(CURLOPT_CUSTOMREQUEST, $this->method);
        }
    }





    /**
     * @param array $headers
     *
     * @return void
    */
    private function setHeaders(array $headers = []): void
    {
        $this->setOptions([CURLOPT_HTTPHEADER => $headers]);
    }





    /**
     * @return int
     */
    private function errno(): int
    {
        return curl_errno($this->ch);
    }




    /**
     * @return string
    */
    private function error(): string
    {
        return curl_error($this->ch);
    }




    /**
     * @return bool|string
     */
    private function exec(): bool|string
    {
        return curl_exec($this->ch);
    }
}