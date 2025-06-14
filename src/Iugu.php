<?php

namespace acaodireta;

use acaodireta\Contracts\CustomerInterface;
use acaodireta\Contracts\PaymentMethodInterface;
use acaodireta\Contracts\ChargeInterface;
use acaodireta\Contracts\InvoiceInterface;
use acaodireta\Contracts\WebhookInterface;
use acaodireta\Services\Customer;
use acaodireta\Services\PaymentMethod;
use acaodireta\Services\Charge;
use acaodireta\Services\Invoice;
use acaodireta\Services\Webhook;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;

class Iugu
{
    public function __construct(
        public readonly string $apiKey,
        private ?ClientInterface $http = null
    ) {
        $this->http = $http ?: new HttpClient([
            'base_uri' => 'https://api.iugu.com/v1/',
            'headers' => [
                'Authorization' => sprintf('Basic %s', base64_encode($this->apiKey.':'.'')),
            ],
        ]);
    }

    /**
     * customer - Serviço de Cliente
     *
     * @return \acaodireta\Services\Customer
     */
    public function customer(): CustomerInterface
    {
        return new Customer($this->http, $this);
    }

    /**
     * paymentMethod - Serviço de Método de Pagamento
     *
     * @return \acaodireta\Services\PaymentMethod
     */
    public function paymentMethod(): PaymentMethodInterface
    {
        return new PaymentMethod($this->http, $this);
    }

    /**
     * charge - Serviço de Cliente
     *
     * @return \acaodireta\Services\Charge
     */
    public function charge(): ChargeInterface
    {
        return new Charge($this->http, $this);
    }

    /**
     * invoice - Serviço de Fatura
     *
     * @return \acaodireta\Services\Invoice
     */
    public function invoice(): InvoiceInterface
    {
        return new Invoice($this->http, $this);
    }

    /**
     * webhook - Serviço de Webhook
     * 
     * @return \acaodireta\Services\Webhook
     */
    public function webhook(): WebhookInterface
    {
        return new Webhook($this->http, $this);
    }
}
