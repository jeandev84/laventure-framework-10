<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Message;
use Laventure\Component\Http\Message\Response\Body\ResponseBody;
use Laventure\Component\Http\Message\Response\Headers\ResponseHeaders;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Response
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
 */
class Response extends Message implements ResponseInterface
{

    /**
     * @var int
    */
    protected int $status;



    /**
     * @var string
    */
    protected string $reasonPhrase = '';



    /**
     * @param int $status
     * @param array $headers
     * @param StreamInterface|null $body
    */
    public function __construct(int $status = 200, array $headers = [], StreamInterface $body = null)
    {
        parent::__construct('', new ResponseHeaders($headers), $body ?: new ResponseBody());
        $this->status  = $status;
    }



    /**
     * @param string $content
     *
     * @return $this
    */
    public function setContent(string $content): static
    {
        $this->body->write($content);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getStatusCode(): int
    {
        return $this->status;
    }





    /**
     * @inheritDoc
    */
    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        $this->status       = $code;
        $this->reasonPhrase = $reasonPhrase;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }





    /**
     * @return void
    */
    public function send(): void
    {
        if (php_sapi_name() !== 'cli') {
            $this->sendResponseCode();
            $this->sendHeaders();
        }
    }








    /**
     * Returns response has string
     *
     * @return string
    */
    public function __toString(): string
    {
        return (string)$this->getBody();
    }





    /**
     * @return void
    */
    protected function sendResponseCode(): void
    {
        if ($this->reasonPhrase) {
            header(sprintf(
                '%s %s %s',
                $this->version,
                $this->status,
                $this->reasonPhrase
            ));
            return;
        }

        http_response_code($this->status);
    }




    protected function sendHeaders(): void
    {
        foreach ($this->getHeaders() as $name => $values) {
            header(sprintf('%s: %s', $name, join(", ", $values)));
        }

        if (ob_get_status()) {
            $content = ob_get_clean();
            $this->setContent($content);
        }
    }
}
