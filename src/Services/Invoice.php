<?php

namespace acaodireta\Services;

use acaodireta\Contracts\InvoiceInterface;
use acaodireta\Iugu;
use GuzzleHttp\ClientInterface;

class Invoice extends BaseRequest implements InvoiceInterface
{
    public function __construct(private ClientInterface $http, private Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * create
     *
     * Cria uma nova fatura.
     *
     * @param array $params
     * @return array
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'invoices');

        return $this->fetchResponse();
    }

    /**
     * capture
     *
     * Captura uma fatura.
     *
     * @param  int $id
     * @return array
     */
    public function capture($id)
    {
        $this->sendApiRequest('POST', sprintf('invoices/%s/capture', $id));

        return $this->fetchResponse();
    }

    /**
     * find
     *
     * Procura uma fatura
     *
     * @param  int $id
     * @return array
     */
    public function find($id)
    {
        $this->sendApiRequest('GET', sprintf('invoices/%s', $id));

        return $this->fetchResponse();
    }

    public function findAll($query)
    {
        $this->sendApiRequest('GET', 'invoices?query='.$query);

        return $this->fetchResponse();
    }

    /**
     * refund
     *
     * Exclui uma fatura
     *
     * @param  int $id
     * @return array
     */
    public function refund($id)
    {
        $this->sendApiRequest('POST', sprintf('invoices/%s/refund', $id));

        return $this->fetchResponse();
    }

    /**
     * cancel
     *
     * Cancela uma fatura
     *
     * @param  int $id
     * @return array
     */
    public function cancel($id)
    {
        $this->sendApiRequest('PUT', sprintf('invoices/%s/cancel', $id));

        return $this->fetchResponse();
    }

    /**
     * send_email
     *
     * Reenvia o e-mail da fatura para o cliente
     *
     * @param string $id
     * @return array
     */
    public function sendEmail($id)
    {
        $this->sendApiRequest('POST', sprintf('invoices/%s/send_email', $id));
        return $this->fetchResponse();
    }
}
