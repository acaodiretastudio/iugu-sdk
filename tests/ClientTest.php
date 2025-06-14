<?php

namespace acaodireta;

use Mockery;
use acaodireta\Contracts\CustomerInterface;

class ClientTest extends TestCase
{
    /**
     * @var \acaodireta\Iugu
     */
    protected $iugu;

    public function setUp(): void
    {
        parent::setUp();

        $this->iugu = new Iugu(
            'TOKEN',
            Mockery::mock(CustomerInterface::class)
        );
    }

    public function testCustomerService()
    {
        $this->assertInstanceOf(CustomerInterface::class, $this->iugu->customer());
    }
}