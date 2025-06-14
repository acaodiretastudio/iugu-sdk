<?php

namespace acaodireta\Contracts;

interface WebhookInterface
{
    public function list();
    public function find($webhookId);
    public function resend(string $initialDate, string $finalDate, string $event);
}
