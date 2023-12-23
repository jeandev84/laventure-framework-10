<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Stream;

use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\ValueObject\IsStream;
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

        $this->openResource(new IsStream($resource));
    }




    /**
     * @param IsStream $stream
     *
     * @return void
    */
    public function openResource(IsStream $stream): void
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
        # ['w', 'w+', 'a', 'a+', 'c', 'c+']
        return $this->matchAccessModes(['x', 'w', 'c', 'a', '+']);
    }







    /**
     * @inheritDoc
    */
    public function write(string $string): int
    {
        $id = fwrite($this->stream, $string);
        $this->close();
        return $id;
    }






    /**
     * @inheritDoc
    */
    public function isReadable(): bool
    {
        # # ['r', 'r+', 'x', 'x+']
        return $this->matchAccessModes(['r', 'x', '+']);
    }







    /**
     * @inheritDoc
    */
    public function read(int $length): string
    {
        return (string)fgets($this->stream, $length);
    }





    /**
     * @param int $length
     *
     * @return $this
     */
    public function length(int $length): static
    {
        $this->length = $length;

        return $this;
    }





    /**
     * @param int $offset
     *
     * @return $this
    */
    public function offset(int $offset): static
    {
        $this->offset = $offset;

        return $this;
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




    /**
     * @param array $modes
     * @return bool
    */
    private function matchAccessModes(array $modes): bool
    {
        $mode = $this->getMetadata('mode');

        foreach ($modes as $accessMode) {
            if(strstr($mode, $accessMode)) {
                return true;
            }
        }

        return false;
    }
}
