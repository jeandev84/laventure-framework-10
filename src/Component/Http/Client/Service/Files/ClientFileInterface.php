<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Files;


/**
 * ClientFileInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Files
 */
interface ClientFileInterface
{
      /**
       * @return string
      */
      public function getPath(): string;


      /**
       * @return string
      */
      public function getMimeType(): string;



      /**
       * @return string
      */
      public function getFilename(): string;
}