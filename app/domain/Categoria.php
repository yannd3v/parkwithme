<?php

namespace App\domain;

class Categoria
{
    public const CARRO = 'CARRO';
    public const MOTO = 'MOTO';
    public const VAN = 'VAN';
    public const ONIBUS = 'ONIBUS';
    public const CAMINHAO = 'CAMINHAO';

    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function CARRO(): self
    {
        return new self(self::CARRO);
    }

    public static function MOTO(): self
    {
        return new self(self::MOTO);
    }

    public static function VAN(): self
    {
        return new self(self::VAN);
    }

    public static function ONIBUS(): self
    {
        return new self(self::ONIBUS);
    }

    public static function CAMINHAO(): self
    {
        return new self(self::CAMINHAO);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

