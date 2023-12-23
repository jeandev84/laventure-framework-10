<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Psr\Http\Message\StreamInterface;

/**
 * JsonResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
*/
class JsonResponse extends Response
{
    /**
     * @var array|object
    */
    protected array|object $data;



    /**
     * @var array|string[]
    */
    private array $defaultHeaders = [
        'Content-Type' => 'application/json; charset=UTF-8'
    ];




    /**
     * @param array|object $data
     *
     * @param int $status
     *
     * @param array $headers
    */
    public function __construct(array|object $data, int $status = 200, array $headers = [])
    {
        parent::__construct($status, array_merge($this->defaultHeaders, $headers));
        $this->setContent($this->encode($data));
    }





    /**
     * @param array|object $data
     *
     * @return false|string
    */
    private function encode(array|object $data): bool|string
    {
        $content = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

        if (json_last_error()) {
            trigger_error(json_last_error_msg());
        }

        return $content;
    }
}
