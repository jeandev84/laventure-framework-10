<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\File;

/**
 * UploadedFileTransformer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\File
 */
class UploadedFileTransformer
{
    /**
     * @param array $files
     *
     * @return array
    */
    public static function transformFromGlobals(array $files): array
    {
        $transformed = [];

        foreach ($files as $name => $fileInfo) {
            if (is_array($fileInfo['name'])) {
                foreach ($fileInfo as $attribute => $file) {
                    foreach ($file as $index => $value) {
                        $transformed[$name][$index][$attribute] = $value;
                    }
                }
            } else {
                $transformed[$name][] = $fileInfo;
            }
        }

        return $transformed;
    }
}
