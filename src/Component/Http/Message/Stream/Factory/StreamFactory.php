<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Stream\Factory;


use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

/**
 * StreamFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Stream\Factory
 */
class StreamFactory implements StreamFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function createStream(string $content = ''): StreamInterface
    {
          $stream = new Stream('php://temp', 'w');
          if ($content) {
              $stream->write($content);
          }
          return $stream;
    }




    /**
     * @inheritDoc
     * @throws StreamException
     */
    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
         return new Stream($filename, $mode);
    }


    /**
     * @inheritDoc
     * @throws StreamException
    */
    public function createStreamFromResource($resource): StreamInterface
    {
         return new Stream($resource);
    }
}