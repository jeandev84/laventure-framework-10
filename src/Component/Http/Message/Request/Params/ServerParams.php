<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Params;

use Laventure\Component\Http\Parameter\Parameter;

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
    public function name(): string
    {
        return $this->string('SERVER_NAME');
    }




    /**
     * @return int
    */
    public function port(): int
    {
        return $this->integer('SERVER_PORT');
    }





    /**
     * @return string
    */
    public function host(): string
    {
        return $this->string('HTTP_HOST');
    }




    /**
     * @return string
    */
    public function referer(): string
    {
        return $this->string('HTTP_REFERER');
    }





    /**
     * OLD method for getting http request headers
     *
     * @return array
    */
    public function headers(): array
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
    public function protocolVersion(): string
    {
        return $this->string('SERVER_PROTOCOL');
    }






    /**
       * @return string
      */
    public function requestMethod(): string
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
        $this->set('REQUEST_METHOD', strtoupper($method));
    }






    /**
     * @return string
    */
    public function requestUri(): string
    {
        return $this->string('REQUEST_URI');
    }







    /**
     * @return string
    */
    public function queryString(): string
    {
        return $this->string('REQUEST_QUERY');
    }






    /**
     * @return int
    */
    public function requestTime(): int
    {
        return $this->integer("REQUEST_TIME");
    }





    /**
     * @return float
    */
    public function requestTimeAsFloat(): float
    {
        return $this->float("REQUEST_TIME_FLOAT");
    }




    /**
     * @return string
    */
    public function documentRoot(): string
    {
        return $this->string('DOCUMENT_ROOT');
    }





    /**
     * @return string
    */
    public function scriptName(): string
    {
        return $this->string('SCRIPT_NAME');
    }







    /**
     * @return string
    */
    public function scriptFilename(): string
    {
        return $this->string('SCRIPT_FILENAME');
    }






    /**
     * @return string
    */
    public function phpSelf(): string
    {
        return $this->string('PHP_SELF');
    }




    /**
     * @return string
    */
    public function remoteAddress(): string
    {
        return $this->string('REMOTE_ADDR');
    }





    /**
     * @return int
    */
    public function remotePort(): int
    {
        return $this->integer('REMOTE_PORT');
    }






    /**
     * @return string
    */
    public function pathInfo(): string
    {
        $path = strtok($this->requestUri(), '?');

        return $this->get('PATH_INFO', $path);
    }





    /**
     * @return string
    */
    public function username(): string
    {
        return $this->string('PHP_AUTH_USER');
    }






    /**
     * @return string
    */
    public function password(): string
    {
        return $this->string('PHP_AUTH_PW');
    }





    /**
     * @return string
    */
    public function authority(): string
    {
        if (!$user = $this->username()) {
            return '';
        }

        return sprintf('%s:%s@', $user, $this->password());
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
        return $this->isHttps() && $this->port() == 443;
    }





    /**
     * Returns scheme protocol
     *
     * @return string
    */
    public function scheme(): string
    {
        return $this->isSecure() ? 'https' : 'http';
    }




    /**
     * @return string
    */
    public function baseUrl(): string
    {
        return sprintf('%s://%s%s', $this->scheme(), $this->authority(), $this->host());
    }




    /**
     * @return string
    */
    public function url(): string
    {
        return sprintf('%s%s', $this->baseUrl(), $this->requestUri());
    }
}
