<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response\Body;

use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;

/**
 * ResponseBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response\Body
 */
class ResponseBody extends Stream
{
    /**
     * @var string
    */
    protected string $content = '';



    /**
     * @param string $resource
     *
     * @throws StreamException
    */
    public function __construct(string $resource = '')
    {
        parent::__construct($resource ?: 'php://output', 'w');
    }


    /**
     * @param string $string
     * @return int
    */
    public function write(string $string): int
    {
        ob_start();
        parent::write($string);
        $this->content .= ob_get_clean();
        return 1;
    }





    /**
     * @return string
    */
    public function __toString(): string
    {
        return $this->content;
    }
}


/*
$stdout = fopen('php://stdout', 'w');
ob_start();
echo "echo output\n";
fwrite($stdout, "FWRITTEN\n");
echo "Also echo\n";
$out = ob_get_clean();
echo $out;
*/
