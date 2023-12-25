<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Encoder;

use Laventure\Component\Http\Message\Response\Encoder\Contract\EncoderInterface;

/**
 * JsonEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Encoder
 */
class JsonEncoder implements EncoderInterface
{
    /**
     * @inheritDoc
    */
    public static function encode($data): string
    {
        $content = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

        if (json_last_error()) {
            trigger_error(json_last_error_msg());
        }

        return $content;
    }
}
