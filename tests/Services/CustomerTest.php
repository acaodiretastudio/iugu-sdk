<?php

namespace acaodireta\Services;

use acaodireta\TestCase;
use acaodireta\Exceptions\IuguValidationException;
use acaodireta\Iugu;

class CustomerTest extends TestCase
{
    protected $iugu;

    public function setUp(): void
    {
        parent::setUp();

        $this->iugu = new Iugu('TOKEN');
    }

    public function test_create_customer()
    {
        $body = __DIR__ . '/../ResponseSamples/Customers/Customer.json';
        $http = $this->mockHttpClient($body);

        $customer = new Customer($http, $this->iugu);
        $customer = $customer->create([
            'name' => 'Nome do Cliente',
            'email' => 'email@email.com'
        ]);

        $this->assertArrayHasKey('name', $customer);
        $this->assertArrayHasKey('email', $customer);

    }

    public function test_find_customer()
    {
        $body = __DIR__ . '/../ResponseSamples/Customers/Customer.json';
        $http = $this->mockHttpClient($body);

        $customer = new Customer($http, $this->iugu);
        $customer = $customer->find('77C2565F6F064A26ABED4255894224F0');

        $this->assertEquals('77C2565F6F064A26ABED4255894224F0', $customer['id']);
    }

    public function test_delete_customer()
    {
        $body = __DIR__ . '/../ResponseSamples/Customers/Customer.json';
        $http = $this->mockHttpClient($body);

        $customer = new Customer($http, $this->iugu);
        $customer = $customer->delete('77C2565F6F064A26ABED4255894224F0');

        $this->assertEquals('77C2565F6F064A26ABED4255894224F0', $customer['id']);
    }

}