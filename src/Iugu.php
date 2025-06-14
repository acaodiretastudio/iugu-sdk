<?php

namespace acaodireta;

use acaodireta\Contracts\CustomerInterface;
use acaodireta\Contracts\PaymentMethodInterface;
use acaodireta\Contracts\ChargeInterface;
use acaodireta\Contracts\InvoiceInterface;
use acaodireta\Services\Customer;
use acaodireta\Services\PaymentMethod;
use acaodireta\Services\Charge;
use acaodireta\Services\Invoice;
use acaodireta\Exceptions\IuguException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;

class Iugu
{

    /**
     * Serviço de Cliente
     *
     * @var \acaodireta\Contracts\CustomerInterface
     */
    protected $customer;

    /**
     * Serviço de Método de Pagamento
     *
     * @var \acaodireta\Contracts\PaymentMethodInterface
     */
    protected $paymentMethod;

    /**
     * Serviço de Cobrança
     *
     * @var \acaodireta\Contracts\ChargeInterface
     */
    protected $charge;

    /**
     * Serviço de Fatura
     *
     * @var \acaodireta\Contracts\InvoiceInterface
     */
    protected $invoice;

    /**
     * apiKey público
     *
     * @var string
     */
    private $apiKey;

    public function __construct(
        $apiKey,
        CustomerInterface $customer = null,
        PaymentMethodInterface $paymentMethod = null,
        ChargeInterface $charge = null,
        InvoiceInterface $invoice = null,
        ClientInterface $http = null
    ) {
        if (!is_string($apiKey)) {
            throw new IuguException('A API Key precisa ser uma string');
        }
        
        $this->apiKey = $apiKey;
        $this->http = $http ?: new HttpClient([
            'base_uri' => 'https://api.iugu.com/v1/',
            'headers' => [
                'Authorization' => sprintf('Basic %s', base64_encode($apiKey.':'.'')),
            ],
        ]);

        $this->customer = $customer ?: new Customer($this->http, $this);
        $this->paymentMethod = $paymentMethod ?: new PaymentMethod($this->http, $this);
        $this->charge = $charge ?: new Charge($this->http, $this);
        $this->invoice = $invoice ?: new Invoice($this->http, $this);
    }

    /**
     * customer
     *
     * Serviço de Cliente
     *
     * @return \acaodireta\Services\Customer
     */
    public function customer()
    {
        return $this->customer;
    }

    /**
     * paymentMethod
     *
     * Serviço de Método de Pagamento
     *
     * @return \acaodireta\Services\PaymentMethod
     */
    public function paymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * charge
     *
     * Serviço de Cliente
     *
     * @return \acaodireta\Services\Charge
     */
    public function charge()
    {
        return $this->charge;
    }

    /**
     * invoice
     *
     * Serviço de Fatura
     *
     * @return \acaodireta\Services\Invoice
     */
    public function invoice()
    {
        return $this->invoice;
    }
}
