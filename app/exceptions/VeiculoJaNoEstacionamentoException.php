<?php

namespace App\exceptions;

use RuntimeException;

class VeiculoJaNoEstacionamentoException extends RuntimeException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
