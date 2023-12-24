<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\File;

use Laventure\Component\Http\Message\Request\File\Exception\UploadedFileException;
use Laventure\Component\Http\Message\Stream\Stream;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * UploadedFile
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\File
 */
class UploadedFile implements UploadedFileInterface
{
    /**
     * File name
     *
     * @var string
    */
    protected string $name;



    /**
     * File path
     *
     * @var string
     */
    protected string $path;



    /**
     * File mime type
     *
     * @var string
    */
    protected string $type;



    /**
     * TempFile path
     *
     * @var string
    */
    protected string $temp;




    /**
     * File error
     *
     * @var int
    */
    protected int $error;




    /**
     * File size
     *
     * @var int
    */
    protected int $size;




    /**
     * @var StreamInterface|null
    */
    protected ?StreamInterface $stream = null;


    /**
     * File constructor.
     *
     * @param string $name
     *
     * @param string|null $path
     *
     * @param string $type
     *
     * @param string|null $temp
     *
     * @param int|null $error
     *
     * @param int|null $size
     */
    public function __construct(
        string $name,
        ?string $path,
        string $type,
        ?string $temp,
        ?int $error,
        ?int $size
    ) {
        $this->name = $name;
        $this->path = $path;
        $this->type = $type;
        $this->temp = $temp;
        $this->error = $error;
        $this->size = $size;
    }




    /**
     * @param StreamInterface $stream
     *
     * @return $this
    */
    public function withStream(StreamInterface $stream): static
    {
        $this->stream = $stream;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getStream(): StreamInterface
    {
        return $this->stream ?: new Stream('php://temp');
    }





    /**
     * @return bool
    */
    public function isOk(): bool
    {
        return is_uploaded_file($this->name);
    }




    /**
     * @inheritDoc
    */
    public function moveTo(string $targetPath): void
    {
        if($this->error !== UPLOAD_ERR_OK) {
            throw new UploadedFileException('message', $this->error);
        }

        $dirname = dirname($targetPath);

        if(!is_dir($dirname)) {
            @mkdir($dirname, 0777, true);
        }

        move_uploaded_file($this->temp, $targetPath);
    }





    /**
     * @inheritDoc
    */
    public function getSize(): ?int
    {
        return $this->size;
    }




    /**
     * @inheritDoc
    */
    public function getError(): int
    {
        return $this->error;
    }




    /**
     * @inheritDoc
    */
    public function getClientFilename(): ?string
    {
        return $this->name;
    }





    /**
     * @inheritDoc
    */
    public function getClientMediaType(): ?string
    {
        return $this->type;
    }
}
