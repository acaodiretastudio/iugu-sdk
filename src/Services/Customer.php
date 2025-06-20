<?php

namespace acaodireta\Services;

use acaodireta\Contracts\CustomerInterface;
use acaodireta\Services\BaseRequest;
use acaodireta\Iugu;
use GuzzleHttp\ClientInterface;

class Customer extends BaseRequest implements CustomerInterface
{
    public function __construct(private ClientInterface $http, private Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * create
     *
     * Cria um novo cliente.
     *
     * @param array $params
     * @return array
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'customers');

        return $this->fetchResponse();
    }

    /**
     * update
     *
     * Atualizar um cliente.
     *
     * @param  int $id
     * @param  array  $params
     * @return array
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', sprintf('customers/%s', $id));

        return $this->fetchResponse();
    }

    /**
     * find
     *
     * Procura um cliente
     *
     * @param  int $id
     * @return array
     */
    public function find($id)
    {
        $this->sendApiRequest('GET', sprintf('customers/%s', $id));

        return $this->fetchResponse();
    }

    /**
     * delete
     *
     * Exclui um cliente
     *
     * @param  int $id
     * @return array
     */
    public function delete($id)
    {
        $this->sendApiRequest('DELETE', sprintf('customers/%s', $id));

        return $this->fetchResponse();
    }
}
