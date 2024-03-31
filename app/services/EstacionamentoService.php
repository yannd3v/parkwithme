<?php

namespace App\services;

use App\domain\Categoria;
use App\domain\Estacionamento;
use App\exceptions\VeiculoJaNoEstacionamentoException;
use App\exceptions\VeiculoNaoAptoParaCadastroException;
use App\exceptions\VeiculoNaoExisteException;
use App\repository\EstacionamentoRepository;
use App\tui\Console;
use DateTimeImmutable;
use DateTimeZone;
use Exception;


class EstacionamentoService
{
    private static EstacionamentoRepository $estacionamentoRepository;

    public function __construct(EstacionamentoRepository $estacionamentoRepository)
    {
        self::$estacionamentoRepository = $estacionamentoRepository;
    }

    public static function listAll(): void
    {

        $estacionamentos = self::$estacionamentoRepository->findAll();
        Console::imprimir($estacionamentos);
    }

    public static function cadastrarVeiculo(): void
    {

        $estacionamento = new Estacionamento();
        self::definirCategoria($estacionamento);
        self::definirPlaca($estacionamento);
        self::definirTaxa($estacionamento);
        self::definirHoraEntrada($estacionamento);
        self::aptoParaCadastro($estacionamento);
    }

    public static function aptoParaCadastro(Estacionamento $estacionamento): void
    {
        if ($estacionamento->getPlacaVeiculo() === null || $estacionamento->getEntrou()) {
            throw new VeiculoNaoAptoParaCadastroException("Já foi realizada uma entrada de veículo com essa placa no estacionamento");
        }

        Console::imprimir("Cadastrado.");
        $estacionamento->setEntrou(true);
//        $this->estacionamentoRepository->save($estacionamento);
        $estacionamento->save();
    }

    public static function definirCategoria(Estacionamento $estacionamento): void
    {
        $opcao = 0;
        while ($opcao != 5 && $opcao != 4 && $opcao != 3 && $opcao != 2 && $opcao != 1) {
            Console::imprimir("Qual a categoria do veículo?" . "\n" . "1. Carro" . "\n" . "2. Moto"
                . "\n" . "3. Van" . "\n" . "4. Caminhão" . "\n" . "5. Ônibus");
            $opcao = intval(trim(fgets(STDIN)));
            switch ($opcao) {
                case 1:
                    $estacionamento->setTipoVeiculo(Categoria::CARRO);
                    break;
                case 2:
                    $estacionamento->setTipoVeiculo(Categoria::MOTO);
                    break;
                case 3:
                    $estacionamento->setTipoVeiculo(Categoria::VAN);
                    break;
                case 4:
                    $estacionamento->setTipoVeiculo(Categoria::CAMINHAO);
                    break;
                case 5:
                    $estacionamento->setTipoVeiculo(Categoria::ONIBUS);
                    break;
                default:
                    Console::imprimir("Opção inválida");
                    break;
            }
        }
    }

    public static function definirHoraEntrada(Estacionamento $estacionamento): void
    {
        $estacionamento->setEntrada(new DateTimeImmutable('now', new DateTimeZone('UTC')));
    }

    public static function definirHoraSaida(Estacionamento $estacionamento): void
    {
        $estacionamento->setSaida(new DateTimeImmutable('now', new DateTimeZone('UTC')));
        $entrada = $estacionamento->getEntrada();
        $saida = $estacionamento->getSaida();
        $tempoPermanencia = $saida->diff($entrada)->i;
        $estacionamento->setTempoPermanencia($tempoPermanencia);
    }

    public static function sair(): void
    {
        Console::imprimir("Informe o ID do veículo:");
        $idVeiculo = intval(trim(fgets(STDIN)));

        try {
            $estacionamento = self::$estacionamentoRepository->find($idVeiculo);
            if (!$estacionamento) {
                throw new VeiculoNaoExisteException("Veículo não encontrado, verifique o ID do veículo");
            }

            self::definirHoraSaida($estacionamento);
            $estacionamento->setSaiu(true);
//            $this->estacionamentoRepository->save($estacionamento);
            $estacionamento->save();
            Console::imprimir("O veículo de ID " . $estacionamento->getId() . " e placa " . $estacionamento->getPlacaVeiculo()
                . " saiu do estacionamento");
        } catch (Exception $e) {
            Console::imprimir($e->getMessage());
        }
    }

    public static function removerVeiculoDaLista(): void
    {
        Console::imprimir("Deseja remover um veículo da lista?" . "\n" . "1. Sim" . "\n" . "2. Não");
        $opcao = intval(trim(fgets(STDIN)));
        switch ($opcao) {
            case 1:
                $veiculo = self::findByIdWithoutParam();
                if ($veiculo) {
//                    $this->estacionamentoRepository->remove($veiculo);
                    $veiculo->delete();
                    Console::imprimir("Removido");
                }
                break;
            default:
                break;
        }
    }

    public static function findByIdWithoutParam(): ?Estacionamento
    {
        Console::imprimir("Qual o ID do veículo?");
        $idVeiculo = intval(trim(fgets(STDIN)));
        return self::$estacionamentoRepository->find($idVeiculo);
    }

    public static function definirPlaca(Estacionamento $estacionamento): void
    {
        Console::imprimir("Qual a placa do veículo?");
        $placa = trim(fgets(STDIN));

        if (self::$estacionamentoRepository->existsByPlaca($placa)) {
            throw new VeiculoJaNoEstacionamentoException("Esse veículo já se encontra no estacionamento ou ainda não foi removido da lista");
        } else {
            $estacionamento->setPlacaVeiculo($placa);
        }
    }

    public static function definirTaxa(Estacionamento $estacionamento): void
    {
        switch ($estacionamento->getTipoVeiculo()) {
            case Categoria::CARRO:
                $estacionamento->setValorTaxa(10);
                break;
            case Categoria::VAN:
                $estacionamento->setValorTaxa(15);
                break;
            case Categoria::MOTO:
                $estacionamento->setValorTaxa(5);
                break;
            case Categoria::ONIBUS:
                $estacionamento->setValorTaxa(20);
                break;
            case Categoria::CAMINHAO:
                $estacionamento->setValorTaxa(25);
                break;
            default:
                break;
        }
    }

    public static function menu(): void
    {
        $opcao = 0;
        while ($opcao != 5) {
            Console::imprimir("===========SYSTEM PARKWITHME============");
            Console::imprimir("1. Entrar veículo" . "\n" . "2. Sair veículo" . "\n"
                . "3. Listar veículos" . "\n" . "4. Remover veículo da lista" . "\n" . "5. Sair");
            $opcao = intval(trim(fgets(STDIN)));
            switch ($opcao) {
                case 1:
                    self::cadastrarVeiculo();
                    break;
                case 2:
                    self::sair();
                    break;
                case 3:
                    self::listAll();
                    break;
                case 4:
                    self::removerVeiculoDaLista();
                    break;
                case 5:
                    Console::imprimir("Saindo...");
                    break;
                default:
                    Console::imprimir("Opção inválida");
                    break;
            }
        }
    }
}
