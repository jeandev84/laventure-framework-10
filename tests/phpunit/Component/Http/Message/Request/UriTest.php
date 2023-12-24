<?php

namespace PHPUnitTest\Component\Http\Message\Request;

use Laventure\Component\Http\Message\Request\Uri;
use PHPUnit\Framework\TestCase;

/**
 * UriTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Http\Message\Request
*/
class UriTest extends TestCase
{
      public function testParsingURI(): void
      {
          $uri = new Uri('http://localhost:8000/users/profile?username=john&active=1#anchor1');

          $this->assertSame('http', $uri->getScheme());
          $this->assertSame('localhost', $uri->getHost());
          $this->assertSame(':', $uri->getUserInfo());
          $this->assertSame(8000, $uri->getPort());
          $this->assertSame('/users/profile', $uri->getPath());
          $this->assertSame('username=john&active=1', $uri->getQuery());
          $this->assertSame('anchor1', $uri->getFragment());
          $this->assertSame('http://localhost:8000/users/profile?username=john&active=1#anchor1', (string)$uri);
      }



      public function testUriToString(): void
      {
          $uri = new Uri('http://username:password@hostname:9090/path?arg=value#anchor');

          $this->assertSame('http://username:password@hostname:9090/path?arg=value#anchor', (string)$uri);
      }
}
