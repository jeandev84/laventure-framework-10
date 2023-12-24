<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client;


use Psr\Http\Message\ResponseInterface;

/**
 * HttpClientInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client
 */
interface HttpClientInterface
{
    /**
     * Send request to client and get a response by each method
     *
     * @param string $method
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface;





    /**
     * Send request to client by method GET
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
     */
    public function get(string $url, array $options = []): ResponseInterface;





    /**
     * Send request to client by method POST
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
    */
    public function post(string $url, array $options = []): ResponseInterface;






    /**
     * Send request to client by method PUT
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
    */
    public function put(string $url, array $options = []): ResponseInterface;







    /**
     * Send request to client by method PATCH
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
    */
    public function patch(string $url, array $options = []): ResponseInterface;






    /**
     * Send request to client by method DELETE
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
    */
    public function delete(string $url, array $options = []): ResponseInterface;
}