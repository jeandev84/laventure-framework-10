<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Contract;


/**
 * ClientService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Contract
 */
abstract class ClientService implements ClientServiceInterface
{


    /**
     * @var array
    */
    protected array $options = [];




    /**
     * @inheritDoc
    */
    public function withOptions(array $options): static
    {
         $this->options = $options;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }
}