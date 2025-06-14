<?php

namespace acaodireta;

use Mockery;
use GuzzleHttp\ClientInterface;
use acaodireta\Contracts\ChargeInterface;
use acaodireta\Contracts\InvoiceInterface;
use acaodireta\Contracts\WebhookInterface;
use acaodireta\Contracts\CustomerInterface;
use acaodireta\Contracts\PaymentMethodInterface;

class IuguTest extends TestCase
{
    private Iugu $iugu;

    public function setUp(): void
    {
        parent::setUp();

        $this->iugu = new Iugu(
            'TOKEN',
            Mockery::mock(ClientInterface::class)
        );
    }

    public function testCustomer()
    {
        $this->assertInstanceOf(CustomerInterface::class, $this->iugu->customer());
    }

    public function testPaymentMethod()
    {
        $this->assertInstanceOf(PaymentMethodInterface::class, $this->iugu->paymentMethod());
    }

    public function testCharge()
    {
        $this->assertInstanceOf(ChargeInterface::class, $this->iugu->charge());
    }

    public function testInvoice()
    {
        $this->assertInstanceOf(InvoiceInterface::class, $this->iugu->invoice());
    }

    public function testWebhook()
    {
        $this->assertInstanceOf(WebhookInterface::class, $this->iugu->webhook());
    }
}