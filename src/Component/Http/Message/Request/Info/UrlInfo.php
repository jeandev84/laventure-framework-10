<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Info;


/**
 * UrlInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Parser
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
        return (string)$this->get(PHP_URL_SCHEME);
    }






    /**
     * @inheritDoc
    */
    public function getUsername(): string
    {
        return (string)$this->get(PHP_URL_USER);
    }



    /**
     * @inheritDoc
    */
    public function getPassword(): string
    {
        return $this->get(PHP_URL_PASS);
    }





    /**
     * @inheritDoc
    */
    public function getHost(): string
    {
        return (string)$this->get(PHP_URL_HOST);
    }





    /**
     * @inheritDoc
    */
    public function getPort(): ?int
    {
        return (int)$this->get(PHP_URL_PORT);
    }




    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return (string)$this->get(PHP_URL_PATH);
    }




    /**
     * @inheritDoc
    */
    public function getQuery(): string
    {
        return (string)$this->get(PHP_URL_QUERY);
    }





    /**
     * @inheritDoc
    */
    public function getFragment(): string
    {
        return (string)$this->get(PHP_URL_FRAGMENT);
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
     * @return array|false|int|string|null
    */
    protected function get(int $key = 0): mixed
    {
        return parse_url($this->targetPath, $key);
    }
}