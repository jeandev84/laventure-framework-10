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
class GlobalParams
{
    /**
     * @var ServerParams
    */
    public ServerParams $server;



    public function __construct()
    {
        $this->server = new ServerParams($_SERVER);
    }




    /**
     * @return array
    */
    public function files(): array
    {
        return UploadedFileTransformer::transform($_FILES);
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