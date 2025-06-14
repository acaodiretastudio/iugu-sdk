# iugu-php-sdk

Biblioteca que realiza integração com a API da [Iugu](http://www.iugu.com)

## Instalação via composer

```bash
$ composer require acaodireta-php/iugu
```

## Serviços

Este SDK suporta os seguintes serviços:

- [Clientes](https://dev.iugu.com/reference#testinput-2)
- [Cobrança direta](https://dev.iugu.com/reference#cobranca-direta)
- [Faturas](https://dev.iugu.com/reference#criar-fatura)
- [Métodos de pagamento](https://dev.iugu.com/reference#testinput-3)

[Referência da API](https://dev.iugu.com/reference)

### Configuração

Para utilizar este SDK, será necessário utilizar seu token de acesso de sua conta Iugu.

```php
use acaodireta;
use acaodireta\Exceptions\IuguException;
use acaodireta\Exceptions\IuguValidationException;

$iugu = new Iugu('SEU_TOKEN');
```

### Clientes

#### Criar cliente

```php
$customer = $iugu->customer()->create([
    'name' => 'Acaodireta',
    'email' => 'contato@gabrielfucci.dev.br',
]);

// Imprime o ID do cliente
echo $customer['id'];
```

#### Atualizar cliente

```php
$customer = $iugu->customer()->update('ID_CLIENTE', [
    'name' => 'John'
]);
```

#### Buscar cliente

```php
$customer = $iugu->customer()->find('ID_CLIENTE');

var_dump($customer);
```

#### Excluir cliente

```php
$iugu->customer()->delete('ID_CLIENTE');
```

### Cobranças diretas

#### Criar cobrança com boleto bancário

```php
$charge = $iugu->charge()->create([
            'method' => 'bank_slip',
            'email' => 'contato@gabrielfucci.dev.br',
            'order_id' => uniqid(),
            'payer' => [
                'cpf_cnpj' => '65634052076',
                'name' => 'Acaodireta',
                'phone_prefix' => '11',
                'phone' => '11111111',
                'email' => 'contato@gabrielfucci.dev.br',
                'address' => [
                    'street' => 'Foo Bar',
                    'number' => '123',
                    'district' => 'Foo',
                    'city' => 'Foo',
                    'state' => 'SP',
                    'zip_code' => '14940000',
                ],
            ],
            'items' => [
                [
                    'description' => 'Item 1',
                    'quantity' => 1,
                    'price_cents' => 1000
                ],
                [
                    'description' => 'Item 2',
                    'quantity' => 2,
                    'price_cents' => 2000
                ],
            ],
        ]);
```

#### Realizar pagamento de uma fatura com cartão

```php
$charge = $iugu->charge()->create([
    'invoice_id' => '12345678',
    'token' => '0000000000000000' // Token gerado através da lib iugu.js
]);
```

## Faturas

#### Criar fatura

```php
$invoice = $iugu->invoice()->create([
    'order_id' => uniqid(),
    'email' => 'contato@gabrielfucci.dev.br',
    'due_date' => '2018-07-14',
    'notification_url' => 'https://webhook.site/08703bf2-d408-4f4c-b91c-0bc8e14352b2',
    'fines' => false,
    'per_day_interest' => false,
    'discount_cents' => 500,
    'ignore_due_email' => true,
    'payable_with' => 'bank_slip',
    'items' => [
        [
            'description' => 'Item 1',
            'quantity' => 1,
            'price_cents' => 1000
        ],
        [
            'description' => 'Item 2',
            'quantity' => 2,
            'price_cents' => 2000
        ],
        [
            'description' => 'Frete',
            'quantity' => 1,
            'price_cents' => 1000
        ],
    ],
    'payer' => [
        'cpf_cnpj' => '65634052076',
        'name' => 'Acaodireta',
        'phone_prefix' => '11',
        'phone' => '11111111',
        'email' => 'contato@gabrielfucci.dev.br',
        'address' => [
            'street' => 'Foo Bar',
            'number' => '123',
            'district' => 'Foo',
            'city' => 'Foo',
            'state' => 'SP',
            'zip_code' => '14940000',
        ],
    ],
]);

// Imprime o ID da fatura
echo $invoice['id'];
```

#### Capturar fatura

```php
$iugu->invoice()->capture('ID_FATURA');
```

#### Buscar fatura

```php
$iugu->invoice()->find('ID_FATURA');
```

#### Reembolsar fatura

```php
$iugu->invoice()->refund('ID_FATURA');
```

#### Cancelar fatura

```php
$iugu->invoice()->cancel('ID_FATURA');
```

## Métodos de pagamento

#### Criar método de pagamento

```php
$payment = $iugu->paymentMethod()->create('ID_CLIENTE', [
    'description' => 'Cartão de Crédito',
    'token' => '123456',
]);

// Imprime o ID do pagamento
echo $payment['id'];
```

#### Atualizar método de pagamento

```php
$iugu->paymentMethod()->update('ID_CLIENTE', 'ID_METODO_PAGAMENTO', [
    'description' => 'Outra description',
]);
```

#### Buscar método de pagamento

```php
$iugu->paymentMethod()->find('ID_CLIENTE', 'ID_METODO_PAGAMENTO');
```

#### Excluir método de pagamento

```php
$iugu->paymentMethod()->delete('ID_CLIENTE', 'ID_METODO_PAGAMENTO');
```

## Testando

```bash
$ composer test
```

## Change log

Consulte [CHANGELOG](.github/CHANGELOG.md) para obter mais informações sobre o que mudou recentemente.

## Contribuindo

Consulte [CONTRIBUTING](.github/CONTRIBUTING.md) para obter mais detalhes.
