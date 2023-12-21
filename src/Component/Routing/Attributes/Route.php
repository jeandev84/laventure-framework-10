<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Attributes;

use Attribute;

#[Attribute]
class Route
{
     public function __construct(
         public string $path
     )
     {
     }
}