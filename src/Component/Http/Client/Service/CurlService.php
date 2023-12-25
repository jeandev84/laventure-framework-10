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
         $this->initializeOptions();
     }




     /**
      * @param string $method
      *
      * @return $this
     */
     public function method(string $method): static
     {
         // TODO refactoring using function match($method)
         switch ($method):
             case 'GET':
             case 'HEAD':
                  $this->setOption(CURLOPT_HEADER, false);
                  break;
             case 'POST':
                 $this->setOption(CURLOPT_POST, 1);
                 break;
             case 'PUT':
             case 'PATCH':
             case 'DELETE':
                 $this->setOption(CURLOPT_CUSTOMREQUEST, $method);
                 break;
         endswitch;

         return parent::method($method);
     }




    /**
     * @inheritDoc
    */
    public function proxy(string $proxy): static
    {
         return $this->setOptions([
             CURLOPT_TIMEOUT => 400,
             CURLOPT_PROXY   => $proxy
         ]);
    }




    /**
     * @inheritDoc
    */
    public function authBasic(AuthBasicOptions $options): static
    {
        return $this->setOption(CURLOPT_USERPWD, $options->toString());
    }





    /**
     * @inheritDoc
    */
    public function oAuth(string $accessToken): static
    {
        return $this->headers([
            "Authorization: $accessToken"
        ]);
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
            $body = $this->buildQueries($body, '', '&');
        }

        $this->parsedBody = $body;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function json(array|string $json): static
    {
        $this->headers(['Content-Type' => 'application/json; charset=UTF-8']);
        $this->jsonBody = (is_array($json) ? $this->encodeJson($json) : $json);

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
        return $this->setOptions([
            CURLOPT_UPLOAD => 1,
            CURLOPT_INFILESIZE => $file['size'],
            CURLOPT_INFILE     => $file['resource']
        ]);
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
     * @throws CurlException
    */
    public function send(): ClientResponseInterface
    {
        // terminate options setting
        $this->terminateOptions();

        // returns the request body
        $body = $this->getBody();

        // returns status code
        $statusCode = $this->getStatusCode();

        // returns request headers
        $headers = $this->getHeaders();

        // close curl
        $this->close();

        // returns client response
        return $this->createResponse($body, $statusCode, $headers);
    }




    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return $this->getInfos();
    }





    /**
     * @param $key
     * @param $value
     * @return $this
    */
    private function setOption($key, $value): static
    {
        curl_setopt($this->ch, $key, $value);

        return $this;
    }




    /**
     * @param array $options
     *
     * @return $this
    */
    private function setOptions(array $options): static
    {
        curl_setopt_array($this->ch, $options);

        return $this;
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





    /**
     * @return void
    */
    private function close(): void
    {
        curl_close($this->ch);
    }




    /**
     * @return mixed
    */
    private function getInfos(): mixed
    {
        return curl_getinfo($this->ch);
    }





    /**
     * @param int $key
     * @return mixed
    */
    private function getInfo(int $key): mixed
    {
        return curl_getinfo($this->ch, $key);
    }





    /**
     * @inheritDoc
    */
    protected function getHeaders(): array
    {
        $this->setOptions([
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true
        ]);

        $response   = $this->exec();
        $headerRows = explode(PHP_EOL, $response);
        $headerRows = array_filter($headerRows, 'trim');
        return $this->filterHeaders($headerRows);
    }





    /**
     * @return void
    */
    private function initializeOptions(): void
    {
        // set default options
        $this->setOptions($this->defaultOptions);
    }




    /**
     * @return void
    */
    private function terminateOptions(): void
    {
        // set curl URL after resolving
        $this->setOption(CURLOPT_URL, $this->getUri());

        // set parsed body
        if (in_array($this->method, ['POST', 'PUT', 'PATCH'])) {
            $this->setOption(CURLOPT_POSTFIELDS, $this->getRequestBody());
        }
    }




    /**
     * @inheritDoc
    */
    protected function getStatusCode(): int
    {
        return (int)$this->getInfo(CURLINFO_HTTP_CODE);
    }


    /**
     * @inheritDoc
     * @throws CurlException
    */
    protected function getBody(): string
    {
        $body = $this->exec();

        // check curl error
        if ($errno = $this->errno()) {
            throw new CurlException($this->error(), $errno);
        }

        return (string)$body;
    }
}