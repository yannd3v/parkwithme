<?php

namespace Tests\services;

use App\domain\Categoria;
use App\domain\Estacionamento;
use App\exceptions\VeiculoJaNoEstacionamentoException;
use App\exceptions\VeiculoNaoAptoParaCadastroException;
use App\repository\EstacionamentoRepository;
use App\services\EstacionamentoService;
use PHPUnit\Framework\TestCase;

class EstacionamentoServiceTest extends TestCase
{
    public function testDefinirCategoria()
    {
        $estacionamento = new Estacionamento();
        $this->expectException(VeiculoNaoAptoParaCadastroException::class);
        EstacionamentoService::definirCategoria($estacionamento);
    }

    public function testDefinirPlaca()
    {
        $estacionamento = new Estacionamento();
        $this->expectException(VeiculoJaNoEstacionamentoException::class);
        EstacionamentoService::definirPlaca($estacionamento);
    }

    public function testDefinirTaxa()
    {
        $estacionamento = new Estacionamento();
        $estacionamento->setTipoVeiculo(Categoria::CARRO);
        EstacionamentoService::definirTaxa($estacionamento);
        $this->assertEquals(10, $estacionamento->getValorTaxa());
    }
}
