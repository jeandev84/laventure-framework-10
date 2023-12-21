<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Attributes;

use Attribute;

#[Attribute]
class Route
{
    public function __construct(
        public string $path,
        public string $methods,
        public string $name = ''
    ) {
    }
}
