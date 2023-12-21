<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Attributes;

use Attribute;
use Laventure\Component\Routing\Enums\HttpMethod;

#[Attribute]
class Put extends Route
{
    public function __construct(string $path, string $name = '')
    {
        parent::__construct($path, HttpMethod::PUT, $name);
    }
}
