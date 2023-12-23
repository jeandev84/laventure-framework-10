<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Stream\ValueObject;


use Laventure\Component\Http\Message\Stream\Exception\StreamException;

/**
 * StreamResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Stream\ValueObject
 */
class StreamResource
{


     /**
      * @var resource
     */
     private $value;




     /**
      * @param resource $value
      *
      * @throws StreamException
     */
     public function __construct($value)
     {
           if (! is_resource($value)) {
                throw new \InvalidArgumentException("Invalid resource type provide.");
           }

           if (get_resource_type($value) !== 'stream') {
                throw new StreamException('Invalid stream provided. must be string or resource stream type provided.');
           }

           $this->value = $value;
     }






     /**
      * @return resource
     */
     public function getValue()
     {
         return $this->value;
     }
}