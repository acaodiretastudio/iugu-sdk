<?php

namespace acaodireta\Exceptions;

use Exception;

class IuguPaymentException extends Exception
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
