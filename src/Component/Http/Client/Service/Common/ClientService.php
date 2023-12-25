<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Common;


use Laventure\Component\Http\Client\Response\ClientResponse;
use Laventure\Component\Http\Client\Response\Contract\ClientResponseInterface;
use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
use Laventure\Component\Http\Client\Service\Cookies\ClientCookieInterface;
use Laventure\Component\Http\Client\Service\Files\ClientFileInterface;
use Laventure\Component\Http\Client\Service\Options\AuthBasicOptions;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOption;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOptionInterface;

/**
 * ClientService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Common
 */
abstract class ClientService implements ClientServiceInterface
{

    /**
     * @var string
    */
    protected string $path = '';


    /**
     * @var string
    */
    protected string $method = '';



    /**
     * @var string
    */
    protected string $parsedBody = '';


    /**
     * @var string
    */
    protected string $jsonBody  = '';



    /**
     * @var array
    */
    protected array $queries = [];



    /**
     * @var array
    */
    protected array $headers = [];



    /**
     * @param string $path
     *
     * @return $this
    */
    public function uri(string $path): static
    {
        $this->path = $path;

        return $this;
    }






    /**
     * @param string $method
     * @return $this
    */
    public function method(string $method): static
    {
        $this->method = $method;

        return $this;
    }





    /**
     * @param array $queries
     *
     * @return $this
    */
    public function queries(array $queries): static
    {
        $this->queries = $queries;

        return $this;
    }







    /**
     * @return string
    */
    public function getUri(): string
    {
        if ($this->queries) {
            $this->path .= "?". $this->buildQueries($this->queries);
        }

        return $this->path;
    }




    /**
     * @return string
    */
    public function getRequestBody(): string
    {
        if ($this->jsonBody) {
            return $this->jsonBody;
        }

        return $this->parsedBody;
    }






    /**
     * @inheritdoc
    */
    public function options(ClientServiceOptionInterface $options): static
    {
         $this->queries($options->query())
              ->proxy($options->proxy())
              ->authBasic($options->authBasic())
              ->oAuth($options->accessToken())
              ->headers($options->headers())
              ->body($options->body())
              ->json($options->json())
              ->files($options->files())
              ->cookies($options->cookies());

         return $this;
    }





    /**
     * @param string $proxy
     *
     * @return $this
    */
    abstract public function proxy(string $proxy): static;







    /**
     * @param AuthBasicOptions $options
     *
     * @return $this
    */
    abstract public function authBasic(AuthBasicOptions $options): static;






    /**
     * Authentication using access token
     *
     * @param string $accessToken
     *
     * @return mixed
    */
    abstract public function oAuth(string $accessToken): static;






    /**
     * @param array $headers
     * @return $this
    */
    abstract public function headers(array $headers): static;






    /**
     * @param array|string $body
     *
     * @return $this
    */
    abstract public function body(array|string $body): static;






    /**
     * @param array|string $json
     *
     * @return $this
    */
    abstract public function json(array|string $json): static;






    /**
     * @param ClientFileInterface[] $files
     *
     * @return $this
    */
    abstract public function files(array $files): static;






    /**
     * @param ClientCookieInterface[] $cookies
     *
     * @return $this
    */
    abstract public function cookies(array $cookies): static;





    /**
     * @param $file
     *
     * @return mixed
    */
    abstract public function upload($file): static;





    /**
     * @param $file
     * @return $this
    */
    abstract public function download($file): static;





    /**
     * Returns response headers
     *
     * @return array
    */
    abstract protected function getHeaders(): array;





    /**
     * Returns response status
     *
     * @return int
    */
    abstract protected function getStatusCode(): int;





    /**
     * Returns response body
     *
     * @return string
    */
    abstract protected function getBody(): string;






    /**
     * @param string $content
     * @param int $statusCode
     * @param array $headers
     * @return ClientResponseInterface
   */
    protected function createResponse(
        string $content = '',
        int $statusCode = 200,
        array $headers = []
    ): ClientResponseInterface
    {
        $response =  new ClientResponse($statusCode, $headers);
        $response->getBody()->write($content);
        return $response;
    }




    /**
     * @param array $params
     * @param string $prefix
     * @param string|null $separator
     * @return string
    */
    protected function buildQueries(
        array $params,
        string $prefix = '',
        ?string $separator = null
    ): string
    {
         return http_build_query($params, $prefix, $separator);
    }





    /**
     * @return bool
     */
    protected function hasOverrideMethods(): bool
    {
        return in_array($this->method, ['PUT', 'DELETE', 'PATCH']);
    }






    /**
     * @param array $headerRows
     *
     * @return array
     */
    protected function filterHeaders(array $headerRows): array
    {
        $headers = [];

        foreach ($headerRows as $header) {
            $position = stripos($header, ':');
            if($position !== false) {
                [$name, $value] = explode(':', $header, 2);
                $headers[$name] = trim($value);
            }
        }

        return $headers;
    }




    /**
     * @param array $headers
     *
     * @return array
    */
    protected function resolveHeaders(array $headers): array
    {
        $resolved = [];

        foreach ($headers as $key => $value) {
            $resolved[] = (is_string($key) ? "$key: $value" : $value);
        }

        return $resolved;
    }





    /**
     * @param array $data
     * @return string
    */
    protected function encodeJson(array $data): string
    {
        return (string)json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}