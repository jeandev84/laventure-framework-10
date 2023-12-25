<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Files;

/**
 * ClientFile
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request\Files
 */
class ClientFile implements ClientFileInterface
{


    /**
     * @param string $fullPath
     * @param string $mimeType
     * @param string $filename
    */
    public function __construct(
        protected string $fullPath,
        protected string $mimeType,
        protected string $filename
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function getFullPath(): string
    {
        return $this->fullPath;
    }





    /**
     * @inheritDoc
    */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }





    /**
     * @inheritDoc
    */
    public function getFilename(): string
    {
        return $this->filename;
    }
}