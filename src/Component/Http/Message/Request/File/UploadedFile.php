<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\File;


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
     * File constructor.
     *
     * @param string $name
     *
     * @param string $path
     *
     * @param string $type
     *
     * @param string $temp
     *
     * @param int $error
     *
     * @param int $size
   */
    public function __construct(string $name, string $path, string $type, string $temp, int $error, int $size)
    {
        $this->name = $name;
        $this->path = $path;
        $this->type = $type;
        $this->temp = $temp;
        $this->error = $error;
        $this->size = $size;
    }




    /**
     * @inheritDoc
    */
    public function getStream(): StreamInterface
    {
        return new Stream();
    }





    /**
     * @inheritDoc
    */
    public function moveTo(string $targetPath): void
    {

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