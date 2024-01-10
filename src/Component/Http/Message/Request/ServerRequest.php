<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request;

use Laventure\Component\Http\Message\Message;
use Laventure\Component\Http\Message\Request\Body\RequestBody;
use Laventure\Component\Http\Message\Request\DTO\FromGlobals;
use Laventure\Component\Http\Message\Request\DTO\FromGlobalsFactory;
use Laventure\Component\Http\Message\Request\Params\Attributes;
use Laventure\Component\Http\Message\Request\Params\CookieParams;
use Laventure\Component\Http\Message\Request\Params\FileParams;
use Laventure\Component\Http\Message\Request\Params\ParsedBody;
use Laventure\Component\Http\Message\Request\Params\QueryParams;
use Laventure\Component\Http\Message\Request\Params\RequestHeaders;
use Laventure\Component\Http\Message\Request\Params\ServerParams;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;

/**
 * ServerRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request
*/
class ServerRequest extends Message implements ServerRequestInterface
{

    /**
     * @var string
    */
    protected string $method;



    /**
     * @var string
    */
    protected string $target;



    /**
     * @var UriInterface
    */
    protected UriInterface $uri;



    /**
     * @var ServerParams
    */
    public ServerParams $server;



    /**
     * @var CookieParams
    */
    public CookieParams $cookies;



    /**
     * @var ParsedBody
    */
    public ParsedBody $request;




    /**
     * @var QueryParams
    */
    public QueryParams $queries;




    /**
     * @var FileParams
    */
    public FileParams $files;




    /**
     * @var Attributes
    */
    public Attributes $attributes;




    /**
     * @param string $method
     * @param string $url
     * @param array $server
     * @param string $version
    */
    public function __construct(string $method, string $url, array $server = [], string $version = '')
    {
        parent::__construct($version, new RequestHeaders(), new RequestBody());
        $this->method     = $method;
        $this->target     = $url;
        $this->uri        = new Uri($url);
        $this->server     = new ServerParams($server);
        $this->cookies    = new CookieParams();
        $this->request    = new ParsedBody();
        $this->queries    = new QueryParams();
        $this->files      = new FileParams();
        $this->attributes = new Attributes();
    }





    /**
     * @inheritDoc
    */
    public function getRequestTarget(): string
    {
        return $this->target;
    }




    /**
     * @inheritDoc
    */
    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        $this->target = $requestTarget;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getMethod(): string
    {
        return $this->server->getMethod();
    }







    /**
     * @inheritDoc
    */
    public function withMethod(string $method): RequestInterface
    {
        $this->method = $method;

        $this->server->setMethod($method);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }




    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        $this->uri = $uri;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getServerParams(): array
    {
        return $this->server->all();
    }





    /**
     * @inheritDoc
    */
    public function getCookieParams(): array
    {
        return $this->cookies->all();
    }





    /**
     * @inheritDoc
    */
    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        $this->cookies->add($cookies);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getQueryParams(): array
    {
        return $this->queries->all();
    }




    /**
     * @inheritDoc
    */
    public function withQueryParams(array $query): ServerRequestInterface
    {
        $this->queries->add($query);

        return $this;
    }




    /**
     * @inheritDoc
     *
     * @return UploadedFileInterface[]
    */
    public function getUploadedFiles(): array
    {
        return $this->files->all();
    }





    /**
     * @inheritDoc
    */
    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        $this->files->add($uploadedFiles);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getParsedBody(): array
    {
        if ($this->request->empty()) {
            parse_str($this->getContent(), $data);
            $this->request->add($data);
        }

        return $this->request->all();
    }





    /**
     * @param string $method
     *
     * @return bool
    */
    public function isMethod(string $method): bool
    {
        return $this->method === strtoupper($method);
    }





    /**
     * Returns content from stream
     *
     * @return string
    */
    public function getContent(): string
    {
        return (string)$this->getBody();
    }





    /**
     * Convert request params json to array
     *
     * @return array
    */
    public function toArray(): array
    {
         return json_decode($this->getContent(), true);
    }






    /**
     * @inheritDoc
    */
    public function withParsedBody($data): ServerRequestInterface
    {
        $this->request->add($data);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return $this->attributes->all();
    }




    /**
     * @inheritDoc
    */
    public function getAttribute(string $name, $default = null)
    {
        return $this->attributes->get($name, $default);
    }




    /**
     * @inheritDoc
    */
    public function withAttribute(string $name, $value): ServerRequestInterface
    {
        $this->attributes->set($name, $value);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withoutAttribute(string $name): ServerRequestInterface
    {
        $this->attributes->remove($name);

        return $this;
    }





    /**
     * @return bool
    */
    public function hasMethodOverride(): bool
    {
        return in_array($this->getMethod(), ['PUT', 'DELETE', 'PATCH']);
    }






    /**
     * @return static
    */
    public static function fromGlobals(): static
    {
        $dto = FromGlobalsFactory::createDto();

        return (new self($dto->method, $dto->url, $dto->server, $dto->version))
            ->withQueryParams($dto->queries)
            ->withParsedBody($dto->parsedBody)
            ->withCookieParams($dto->cookies)
            ->withUploadedFiles($dto->files);
    }

}
