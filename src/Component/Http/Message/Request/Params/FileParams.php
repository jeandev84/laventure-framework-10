<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Params;

use Laventure\Component\Http\Message\Request\Factory\UploadedFileFactory;
use Laventure\Component\Http\Message\Request\Upload\UploadedFile;
use Laventure\Component\Http\Parameter\Parameter;
use Psr\Http\Message\UploadedFileInterface;

/**
 * UploadedFiles
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Params
 */
class FileParams extends Parameter
{
    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }



    /**
     * @param array $params
     *
     * @return $this
    */
    public function add(array $params): static
    {
         foreach ($params as $id => $uploadedFiles) {
             $this->addFiles($id, (array)$uploadedFiles);
         }

         return $this;
    }







    /**
     * @return UploadedFileInterface[]
    */
    public function all(): array
    {
        return parent::all();
    }



    /**
     * @param $id
     *
     * @param UploadedFileInterface[] $uploadedFiles
     *
     * @return void
     */
    private function addFiles($id, array $uploadedFiles): void
    {
        foreach ($uploadedFiles as $uploadedFile) {
            if (is_array($uploadedFile)) {
                $uploadedFile = UploadedFileFactory::createFromArray($uploadedFile);
            }
            if ($uploadedFile instanceof UploadedFileInterface) {
                $this->params[$id][] = $uploadedFile;
            }
        }

    }
}
