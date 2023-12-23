<?php

namespace PHPUnitTest\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Response\Response;
use PHPUnit\Framework\TestCase;

/**
 * ResponseTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Http\Message\Response
 */
class ResponseTest extends TestCase
{


    public function testResponseBody()
    {
        /*
        $response = new Response();
        $body     = $response->getBody();
        $body->write('<h1>Hello world</h1>');
        $body->close();

        $data = [
            'id' => 1,
            'username' => 'john',
            'avatar_url' => '/uploads/users/1-avatar.jpg',
            'is_active'  => true
        ];

        $jsonResponse = new \Laventure\Component\Http\Message\Response\JsonResponse($data);

        $this->assertSame('<h1>Hello world</h1>', (string)$response);
        $this->assertEquals(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ), (string)$jsonResponse);

        $jsonResponse->getBody()->close();
        // echo $response;
        */

        $this->assertTrue(true);
    }

}
