# iugu-php-sdk

Biblioteca que realiza integração com a API da [Iugu](http://www.iugu.com)

## Instalação via composer

```bash
$ composer require acaodiretastudio/iugu-sdk
```

## Serviços

Este SDK suporta os seguintes serviços:

- [Clientes](https://dev.iugu.com/reference/criar-cliente)
- [Faturas](https://dev.iugu.com/reference/criar-fatura)
- [Métodos de pagamento](https://dev.iugu.com/reference/criar-forma-de-pagamento)
- [Webhooks](https://dev.iugu.com/reference/buscar-gatilho)

[Referência da API](https://dev.iugu.com/reference)

### Configuração

Para utilizar este SDK, será necessário utilizar seu token de acesso de sua conta Iugu.

```php
use acaodireta;
use acaodireta\Exceptions\IuguException;
use acaodireta\Exceptions\IuguValidationException;

$iugu = new Iugu('SEU_TOKEN');
```

### Exemplos

```php
$iugu->invoice()->capture('ID_FATURA');
$iugu->customer()->find('ID_CLIENTE');
$iugu->paymentMethod()->find('ID_CLIENTE', 'ID_METODO_PAGAMENTO');
$iugu->webhook()->list();
```

## Testando

```bash
$ composer test
```

## Change log

Consulte [CHANGELOG](.github/CHANGELOG.md) para obter mais informações sobre o que mudou recentemente.

## Contribuindo

Consulte [CONTRIBUTING](.github/CONTRIBUTING.md) para obter mais detalhes.
