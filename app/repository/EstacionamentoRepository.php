<?php

namespace App\repository;

use Doctrine\Persistence\ObjectRepository;

interface EstacionamentoRepository extends ObjectRepository
{
    public function existsByPlaca(string $placa): bool;
}
