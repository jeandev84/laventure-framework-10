<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Utils;

/**
 * UrlInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Utils
*/
class UrlInfo implements UrlInfoInterface
{
    public function __construct(protected string $targetPath)
    {
    }



    /**
     * @inheritDoc
    */
    public function getScheme(): string
    {
        return $this->get(PHP_URL_SCHEME, '');
    }






    /**
     * @inheritDoc
    */
    public function getUsername(): string
    {
        return $this->get(PHP_URL_USER, '');
    }




    /**
     * @inheritDoc
    */
    public function getPassword(): string
    {
        return $this->get(PHP_URL_PASS, '');
    }





    /**
     * @inheritDoc
    */
    public function getHost(): string
    {
        return $this->get(PHP_URL_HOST, '');
    }





    /**
     * @inheritDoc
    */
    public function getPort(): ?int
    {
        return $this->get(PHP_URL_PORT, 0);
    }




    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->get(PHP_URL_PATH, '');
    }




    /**
     * @inheritDoc
    */
    public function getQuery(): string
    {
        return $this->get(PHP_URL_QUERY, '');
    }





    /**
     * @inheritDoc
    */
    public function getFragment(): string
    {
        return $this->get(PHP_URL_FRAGMENT, '');
    }




    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return (array)parse_url($this->targetPath);
    }




    /**
     * @param int $key
     * @param null $default
     * @return array|false|int|string|null
    */
    protected function get(int $key = 0, $default = null): mixed
    {
        $value = parse_url($this->targetPath, $key);

        return ($value ?: $default);
    }
}
