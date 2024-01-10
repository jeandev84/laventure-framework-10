<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Params;

use Laventure\Component\Http\Message\Request\File\UploadedFileTransformer;

/**
 * FromGlobalParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Params
 */
class FromGlobalParams
{
    /**
     * @var ServerParams
    */
    protected ServerParams $server;


    /**
     * @var array
    */
    protected array $files;




    public function __construct()
    {
        $this->server = new ServerParams($_SERVER);
        $this->files  = UploadedFileTransformer::transform($_FILES);
    }



    /**
     * @return string
    */
    public function method(): string
    {
        return $this->server->getMethod();
    }






    /**
     * @return string
    */
    public function url(): string
    {
        return $this->server->getUrl();
    }




    /**
     * @return array
    */
    public function server(): array
    {
        return $this->server->all();
    }




    /**
     * @return string
    */
    public function version(): string
    {
        return $this->server->getProtocolVersion();
    }




    /**
     * @return array
    */
    public function files(): array
    {
        return $this->files;
    }





    /**
     * @return array
    */
    public function queries(): array
    {
        return $_GET;
    }




    /**
     * @return array
    */
    public function body(): array
    {
        return $_POST;
    }





    /**
     * @return array
    */
    public function cookies(): array
    {
        return $_COOKIE;
    }
}