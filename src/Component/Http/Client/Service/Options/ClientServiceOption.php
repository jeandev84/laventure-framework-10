<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Options;


use Laventure\Component\Http\Utils\Parameter;

/**
 * ClientServiceParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Params
 */
class ClientServiceOption extends Parameter implements ClientServiceOptionInterface
{
    /**
     * @var array
    */
    protected array $params = [
        'auth_basic' => [
           'login'    => '',
           'password' => ''
        ],
        'oauth'    => '',
        'query'    => [],
        'headers'  => [],
        'body'     => '',
        'json'     => null,
        'proxy'    => '',
        'files'    => [],
        'cookies'  => []
    ];



    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }




    /**
     * @inheritdoc
    */
    public function query(): array
    {
        return $this->get('query', []);
    }






    /**
     * @inheritdoc
    */
    public function body(): array|string
    {
        return $this->get('body', '');
    }




    /**
     * @inheritDoc
    */
    public function json(): array|string
    {
       return $this->get('json', '');
    }





    /**
     * @inheritdoc
    */
    public function headers(): array
    {
         return $this->get('headers', []);
    }




    /**
     * @inheritdoc
    */
    public function accessToken(): string
    {
        return $this->get('oauth', '');
    }




    /**
     * @inheritdoc
    */
    public function authBasic(): AuthBasicOptions
    {
        return new AuthBasicOptions(
            $this->params['auth_basic']['login'],
            $this->params['auth_basic']['password'],
        );
    }




    /**
     * @inheritDoc
    */
    public function proxy(): string
    {
        return $this->get('proxy', '');
    }




    /**
     * @inheritDoc
    */
    public function files(): array
    {
        return $this->get('files', []);
    }





    /**
     * @inheritDoc
    */
    public function cookies(): array
    {
        return $this->get('cookies', []);
    }
}