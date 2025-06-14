<?php

namespace acaodireta\Services;

use acaodireta\Contracts\WebhookInterface;
use acaodireta\Iugu;
use GuzzleHttp\ClientInterface;

class Webhook extends BaseRequest implements WebhookInterface
{
    public function __construct(private ClientInterface $http, private Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    public function list()
    {
        $this->sendApiRequest('GET', 'web_hooks');

        return $this->fetchResponse();
    }

    public function find($webhookId)
    {
        $this->sendApiRequest('GET', sprintf('web_hooks/%s', $webhookId));

        return $this->fetchResponse();
    }

    public function resend(
        string $initialDate,
        string $finalDate,
        string $event
    ) {
        $this->sendApiRequest('GET', 'web_hooks/resend?initial_date='.$initialDate.'&final_date='.$finalDate.'&event='.$event);

        return $this->fetchResponse();
    }
}
