<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Response\Encoder\JsonEncoder;
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
        $this->setContent(JsonEncoder::encode($data));
    }
}
