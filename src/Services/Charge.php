<?php

namespace acaodireta\Services;

use acaodireta\Contracts\ChargeInterface;
use acaodireta\Iugu;
use GuzzleHttp\ClientInterface;

class Charge extends BaseRequest implements ChargeInterface
{
    public function __construct(private ClientInterface $http, private Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * create
     *
     * Cria uma nova cobrança.
     *
     * @param array $params
     * @return array
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'charge');

        return $this->fetchResponse();
    }
}
