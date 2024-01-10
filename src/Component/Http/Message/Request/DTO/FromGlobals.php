<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\DTO;

use Laventure\Component\Http\Message\Request\File\UploadedFileTransformer;
use Laventure\Component\Http\Message\Request\Params\ServerParams;

/**
 * FromGlobals
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\DTO
 */
class FromGlobals
{

    /**
     * @var array
    */
    public array $queries;



    /**
     * @var array
    */
    public array $parsedBody;



    /**
     * @var array
    */
    public array $server;



    /**
     * @var array
    */
    public array $files;



    /**
     * @var array
    */
    public array $cookies;



    /**
     * @var string
    */
    public string $url;



    /**
     * @var string
    */
    public string $method;



    /**
     * @var string
    */
    public string $version;



    /**
     * @param array $queries
     * @param array $body
     * @param array $server
     * @param array $files
     * @param array $cookies
    */
    public function __construct(
        array $queries,
        array $body,
        array $server,
        array $files,
        array $cookies
    )
    {
        $server            = new ServerParams($server);
        $this->files       = UploadedFileTransformer::transform($files);
        $this->cookies     = $cookies;
        $this->queries     = $queries;
        $this->parsedBody  = $body;
        $this->url         = $server->getUrl();
        $this->method      = $server->getMethod();
        $this->version     = $server->getProtocolVersion();
        $this->server      = $server->all();
    }
}