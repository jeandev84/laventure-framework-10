<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Params;

use Laventure\Component\Http\Utils\Parameter;

/**
 * ServerParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Params
 */
class ServerParams extends Parameter
{
    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->string('SERVER_NAME');
    }




    /**
     * @return int
    */
    public function getPort(): int
    {
        return $this->integer('SERVER_PORT');
    }





    /**
     * @return string
    */
    public function getHost(): string
    {
        return $this->string('HTTP_HOST');
    }




    /**
     * @return string
    */
    public function getReferer(): string
    {
        return $this->string('HTTP_REFERER');
    }





    /**
     * OLD method for getting http request headers
     *
     * @return array
    */
    public function getHeaders(): array
    {
        // TODO using array_filter()

        $headers = [];
        foreach ($this->all() as $key => $value) {
            if(stripos($key, 'HTTP_') === 0) {
                $headers[substr($key, 5)] = $value;
            } elseif (\in_array($key, ['CONTENT_TYPE', 'CONTENT_LENGTH', 'CONTENT_MD5'], true)) {
                $headers[$key] = $value;
            }
        }
        return $headers;
    }








    /**
     * @return string
    */
    public function getProtocolVersion(): string
    {
        return $this->string('SERVER_PROTOCOL');
    }






    /**
       * @return string
      */
    public function getMethod(): string
    {
        return $this->toUpper('REQUEST_METHOD');
    }




    /**
     * @param string $method
     *
     * @return void
    */
    public function setMethod(string $method): void
    {
        if ($this->has('REQUEST_METHOD')) {
            $this->set('REQUEST_METHOD', strtoupper($method));
        }
    }






    /**
     * @return string
    */
    public function getRequestUri(): string
    {
        return $this->string('REQUEST_URI');
    }







    /**
     * @return string
    */
    public function getQueryString(): string
    {
        return $this->string('REQUEST_QUERY');
    }






    /**
     * @return int
    */
    public function getRequestTime(): int
    {
        return $this->integer("REQUEST_TIME");
    }





    /**
     * @return float
    */
    public function getRequestTimeAsFloat(): float
    {
        return $this->float("REQUEST_TIME_FLOAT");
    }




    /**
     * @return string
    */
    public function getDocumentRoot(): string
    {
        return $this->string('DOCUMENT_ROOT');
    }





    /**
     * @return string
    */
    public function getScriptName(): string
    {
        return $this->string('SCRIPT_NAME');
    }







    /**
     * @return string
    */
    public function getScriptFile(): string
    {
        return $this->string('SCRIPT_FILENAME');
    }






    /**
     * @return string
    */
    public function getPhpSelf(): string
    {
        return $this->string('PHP_SELF');
    }





    /**
     * @return string
    */
    public function getRemoteAddress(): string
    {
        return $this->string('REMOTE_ADDR');
    }





    /**
     * @return int
    */
    public function getRemotePort(): int
    {
        return $this->integer('REMOTE_PORT');
    }






    /**
     * @return string
    */
    public function getPathInfo(): string
    {
        $path = strtok($this->getRequestUri(), '?');

        return $this->get('PATH_INFO', $path);
    }





    /**
     * @return string
    */
    public function getUsername(): string
    {
        return $this->string('PHP_AUTH_USER');
    }






    /**
     * @return string
    */
    public function getPassword(): string
    {
        return $this->string('PHP_AUTH_PW');
    }





    /**
     * @return string
    */
    public function getAuthority(): string
    {
        if (!$user = $this->getUsername()) {
            return '';
        }

        return sprintf('%s:%s@', $user, $this->getPassword());
    }





    /**
     * Determine if request via xhr http request
     *
     * @return bool
    */
    public function isXhr(): bool
    {
        return $this->match('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
    }




    /**
     * @return bool
    */
    public function isForwardedProto(): bool
    {
        return $this->get('HTTP_X_FORWARDED_PROTO') == 'https';
    }



    /**
     * @return bool
    */
    public function isHttps(): bool
    {
        return $this->has('HTTPS') || $this->isForwardedProto();
    }





    /**
     * Determine if the HTTP protocol is secure
     * @return bool
    */
    public function isSecure(): bool
    {
        return $this->isHttps() && $this->getPort() == 443;
    }





    /**
     * Returns scheme protocol
     *
     * @return string
    */
    public function getScheme(): string
    {
        return $this->isSecure() ? 'https' : 'http';
    }




    /**
     * @return string
    */
    public function getBaseUrl(): string
    {
        return sprintf('%s://%s%s', $this->getScheme(), $this->getAuthority(), $this->getHost());
    }




    /**
     * @return string
    */
    public function getUrl(): string
    {
        return sprintf('%s%s', $this->getBaseUrl(), $this->getRequestUri());
    }
}
