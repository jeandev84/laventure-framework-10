<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Stream;

use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\ValueObject\StreamResource;
use Psr\Http\Message\StreamInterface;

/**
 * Stream
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Stream
 */
class Stream implements StreamInterface
{


    /**
     * @var resource|string
     */
    protected $stream;



    /**
     * @var ?int
    */
    protected ?int $length = null;


    /**
     * @var int
    */
    protected int $offset = -1;




    /**
     * @var string|null
    */
    protected ?string $path;





    /**
     * @var string|null
    */
    protected ?string $accessMode;



    /**
     * @var bool|null
    */
    protected ?bool $includePath = false;



    /**
     * @var resource|null
    */
    protected $context;




    /**
     * @param $resource
     *
     * @param string $accessMode
     * @throws StreamException
    */
    public function __construct($resource, string $accessMode = '')
    {
         if (is_string($resource)) {
             $resource = fopen($resource, $accessMode);
         }

         $this->openResource(new StreamResource($resource));
    }




    /**
     * @param StreamResource $stream
     *
     * @return void
    */
    public function openResource(StreamResource $stream): void
    {
         $this->stream = $stream->getValue();
    }




    /**
     * @inheritDoc
    */
    public function detach(): void
    {
        $this->stream = null;
    }






    /**
     * @inheritDoc
    */
    public function getSize(): ?int
    {
        return fstat($this->stream)['size'];
    }






    /**
     * @inheritDoc
    */
    public function tell(): int
    {
        return ftell($this->stream);
    }







    /**
     * @inheritDoc
    */
    public function eof(): bool
    {
        return feof($this->stream);
    }




    /**
     * @inheritDoc
    */
    public function isSeekable(): bool
    {
        $meta = $this->getMetadata();

        return $meta['seekable'] ?? false;
    }






    /**
     * @inheritDoc
    */
    public function seek(int $offset, int $whence = SEEK_SET): void
    {
         fseek($this->stream, $offset, $whence);
    }







    /**
     * @inheritDoc
    */
    public function rewind(): void
    {
        rewind($this->stream);
    }





    /**
     * @inheritDoc
    */
    public function isWritable(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function write(string $string): int
    {
        return (int)fwrite($this->stream, $string);
    }






    /**
     * @inheritDoc
    */
    public function isReadable(): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function read(int $length): string
    {
        return (string)fgets($this->stream, $length);
    }




    /**
     * @inheritDoc
    */
    public function getContents(): string
    {
        return stream_get_contents($this->stream, $this->length, $this->offset);
    }





    /**
     * @inheritDoc
    */
    public function getMetadata(?string $key = null)
    {
        $meta = stream_get_meta_data($this->stream);

        return $key ? $meta[$key] : $meta;
    }






    /**
     * @inheritDoc
    */
    public function close(): void
    {
        fclose($this->stream);
    }





    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getContents();
    }
}
