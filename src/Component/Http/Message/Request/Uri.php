<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request;


use Laventure\Component\Http\Message\Request\Utils\UrlInfo;
use Psr\Http\Message\UriInterface;

/**
 * Uri
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request
 */
class Uri implements UriInterface
{

    /**
     * Get scheme
     *
     * @var string
    */
    protected string $scheme = '';




    /**
     * Get host
     *
     * @var string
    */
    protected string $host = '';





    /**
     * Get username
     *
     * @var string
     */
    protected string $username = '';




    /**
     * Get password
     *
     * @var string|null
     */
    protected ?string $password;



    /**
     * Get port
     *
     * @var int
    */
    protected int $port;





    /**
     * Get path
     *
     * @var string
    */
    protected string $path = '';





    /**
     * Builder string
     *
     * @var string
    */
    protected string $query = '';





    /**
     * Fragment request
     *
     * @var string
    */
    protected string $fragment = '';




    /**
     * @var string
    */
    protected string $authority = '';



    /**
     * @param string $path
    */
    public function __construct(string $path = '')
    {
        if ($path !== '') {
            $this->parsePath($path);
        }
    }




    /**
     * @inheritDoc
    */
    public function getScheme(): string
    {
        return $this->scheme;
    }




    /**
     * @inheritDoc
    */
    public function getAuthority(): string
    {
          return $this->authority;
    }





    /**
     * @inheritDoc
    */
    public function getUserInfo(): string
    {
       return "$this->username:$this->password";
    }





    /**
     * @inheritDoc
    */
    public function getHost(): string
    {
        return $this->host;
    }




    /**
     * @inheritDoc
    */
    public function getPort(): ?int
    {
        return $this->port;
    }




    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }





    /**
     * @inheritDoc
     */
    public function getQuery(): string
    {
        return $this->query ? "?$this->query" : '';
    }




    /**
     * @inheritDoc
    */
    public function getFragment(): string
    {
         return $this->fragment ? "#$this->fragment" : '';
    }





    /**
     * @inheritDoc
    */
    public function withScheme(string $scheme): UriInterface
    {
          $this->scheme = $scheme;

          return $this;
    }




    /**
     * @inheritDoc
    */
    public function withUserInfo(string $user, ?string $password = null): UriInterface
    {
          $this->username = $user;
          $this->password = $password;

          return $this;
    }





    /**
     * @inheritDoc
    */
    public function withHost(string $host): UriInterface
    {
         $this->host = $host;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function withPort(?int $port): UriInterface
    {
        $this->port = $port;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function withPath(string $path): UriInterface
    {
          $this->path = $path;

          return $this;
    }




    /**
     * @inheritDoc
    */
    public function withQuery(string $query): UriInterface
    {
        $this->query = $query;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function withFragment(string $fragment): UriInterface
    {
         $this->fragment = $fragment;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
         return sprintf('%s%s%s',
             $this->getPath(),
             $this->getQuery(),
             $this->getFragment()
         );
    }




    /**
     * @param string $path
     *
     * @return void
    */
    private function parsePath(string $path): void
    {
          $info = new UrlInfo($path);

          $this->withScheme($info->getScheme())
               ->withUserInfo($info->getUsername(), $info->getPassword())
               ->withHost($info->getHost())
               ->withPort($info->getPort())
               ->withPath($info->getPath())
               ->withQuery($info->getQuery())
               ->withFragment($info->getFragment());
    }
}