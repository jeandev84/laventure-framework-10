<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Common;


use Laventure\Component\Http\Client\Service\Options\ClientServiceOptionInterface;
use Laventure\Component\Http\Client\Service\Options\Exception\ClientOptionException;

/**
 * ClientServiceTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Common
*/
trait ClientServiceTrait
{


    /**
     * @var array
    */
    private array $handlers = [
        'query'      => 'query',
        'body'       => 'body',
        'json'       => 'json',
        'headers'    => 'headers',
        'proxy'      => 'proxy',
        'cookies'    => 'cookies',
        'auth_basic' => 'authBasic',
        'auth_token' => 'authToken',
        'upload'     => 'upload',
        'download'   => 'download',
        'files'      => 'files'
    ];


    /**
     * @param ClientServiceOptionInterface $options
     * @return $this
     * @throws ClientOptionException
    */
    public function options(ClientServiceOptionInterface $options): static
    {
        foreach ($options->all() as $key => $value) {
            if (!empty($value)) {
                if (array_key_exists($key, $this->handlers)) {
                    $method = $this->handlers[$key];
                    if (! method_exists($this, $method)) {
                        throw new ClientOptionException(
                            "Method '{$method}' does not exist inside : ". get_called_class()
                        );
                    }
                    call_user_func_array([$this, $method], [$value]);
                }
            }
        }


        return $this;
    }

}