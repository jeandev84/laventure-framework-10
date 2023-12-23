<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Factory;

use Laventure\Component\Http\Message\Request\Upload\UploadedFile;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * UploadedFileFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Factory
 */
class UploadedFileFactory implements UploadedFileFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createUploadedFile(
        StreamInterface $stream,
        int $size = null,
        int $error = \UPLOAD_ERR_OK,
        string $clientFilename = null,
        string $clientMediaType = null
    ): UploadedFileInterface {
        $uploadedFile = new UploadedFile($clientFilename, null, $clientMediaType, null, $error, $size);
        $uploadedFile->withStream($stream);
        return $uploadedFile;
    }



    /**
     * @param array $file
     *
     * @return UploadedFileInterface
    */
    public static function createFromArray(array $file): UploadedFileInterface
    {
        return new UploadedFile(
            $file['name'],
            $file['full_path'],
            $file['type'],
            $file['tmp_name'],
            $file['error'],
            $file['size']
        );
    }
}
