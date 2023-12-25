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
        'query'    => [],
        'headers'  => [],
        'body'     => '',
        'json'     => null
    ];



    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }




    /**
     * @inheritdoc
    */
    public function getQueries(): array
    {
        return $this->get('query', []);
    }






    /**
     * @inheritdoc
    */
    public function getBody(): mixed
    {
        return $this->get('body', '');
    }




    /**
     * @inheritDoc
    */
    public function getJson(): mixed
    {
        return $this->get('json', '');
    }







    /**
     * @inheritdoc
    */
    public function getHeaders(): array
    {
         return $this->get('headers', []);
    }
}