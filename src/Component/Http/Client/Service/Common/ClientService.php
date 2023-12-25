<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Common;


use Laventure\Component\Http\Client\Service\Contract\ClientServiceInterface;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOption;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOptionInterface;
use Psr\Http\Message\UriInterface;

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
    protected string $url = '';


    /**
     * @var string
    */
    protected string $method = '';



    /**
     * @var string
    */
    protected $body = null;



    /**
     * @var int
     */
    protected int $statusCode = 0;




    /**
     * @var array
    */
    protected array $headers = [];




    /**
     * @var ClientServiceOptionInterface
    */
    protected ClientServiceOptionInterface $options;




    /**
     * @param ClientServiceOptionInterface|null $options
    */
    public function __construct(ClientServiceOptionInterface $options = null)
    {
          $this->options = $options ?: new ClientServiceOption();
    }




    /**
     * @inheritDoc
    */
    public function url(string $path): static
    {
        $this->url = $path;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function method(string $method): static
    {
        $this->method = $method;

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function parseOptions(array $options): static
    {
        $this->options->add($options);

        return $this;
    }



    /**
     * @param $body
     * @return $this
    */
    public function body($body): static
    {
        $this->body = $body;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getBody(): string
    {
        return $this->body;
    }





    /**
     * @inheritDoc
    */
    public function getHeaders(): array
    {
        return $this->headers;
    }





    /**
     * @inheritDoc
    */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }





    /**
     * @return string
    */
    public function getUri(): string
    {
        if ($queries = $this->options->getQueries()) {
            $this->url .= "?". $this->buildQueryParams($queries);
        }

        return $this->url;
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
     * @param array $params
     * @param string $prefix
     * @param string|null $separator
     * @return string
    */
    protected function buildQueryParams(array $params, string $prefix = '', ?string $separator = null): string
    {
         return http_build_query($params, $prefix, $separator);
    }





    /**
     * @param int $statusCode
     *
     * @return $this
    */
    protected function statusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

}