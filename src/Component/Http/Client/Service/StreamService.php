<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service;


use Laventure\Component\Http\Client\Service\Common\ClientService;
use Laventure\Component\Http\Client\Service\Options\ClientServiceOptionInterface;

/**
 * StreamRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class StreamService extends ClientService
{



    /**
     * @param ClientServiceOptionInterface|null $options
    */
    public function __construct(ClientServiceOptionInterface $options = null)
    {
          parent::__construct($options);
    }


    /**
     * @inheritDoc
     */
    public function getInfo($key): mixed
    {
        return '';
    }



    /**
     * @inheritDoc
     */
    public function getInfos(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function send(): mixed
    {
        return true;
    }
}