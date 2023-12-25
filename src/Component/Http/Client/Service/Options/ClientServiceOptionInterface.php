<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Client\Service\Options;


/**
 * ClientServiceOptionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Service\Options
 */
interface ClientServiceOptionInterface
{
    /**
     * Returns request query
     *
     * @return array
    */
    public function getQueries(): array;





    /**
     * Returns request body
     *
     * @return array|string
    */
    public function getBody(): array|string;







    /**
     * @return string
    */
    public function getJson(): string;








    /**
     * Returns request headers
     *
     * @return array
    */
    public function getHeaders(): array;
}