<?php

namespace App\domain;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Model;

/**
 * @ORM\Entity
 * @ORM\Table(name="estacionamento")
 * @method save()
 * @method delete()
 */
class Estacionamento extends Model
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $tipoVeiculo;

    /**
     * @ORM\Column(type="string")
     */
    private string $placaVeiculo;

    /**
     * @ORM\Column(type="float")
     */
    private float $valorTaxa;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private \DateTimeInterface $entrada;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private \DateTimeInterface $saida;

    /**
     * @ORM\Column(type="integer")
     */
    private int $tempoPermanencia;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entrou;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $saiu;

    public function getTipoVeiculo(): ?string
    {
        return $this->tipoVeiculo;
    }

    public function setTipoVeiculo(string $tipoVeiculo): self
    {
        $this->tipoVeiculo = $tipoVeiculo;

        return $this;
    }

    public function getPlacaVeiculo(): ?string
    {
        return $this->placaVeiculo;
    }

    public function setPlacaVeiculo(string $placaVeiculo): self
    {
        $this->placaVeiculo = $placaVeiculo;

        return $this;
    }

    public function getValorTaxa(): ?float
    {
        return $this->valorTaxa;
    }

    public function setValorTaxa(float $valorTaxa): self
    {
        $this->valorTaxa = $valorTaxa;

        return $this;
    }

    public function getEntrada(): ?DateTimeInterface
    {
        return $this->entrada;
    }

    public function setEntrada(?DateTimeInterface $entrada): self
    {
        $this->entrada = $entrada;

        return $this;
    }

    public function getSaida(): ?DateTimeInterface
    {
        return $this->saida;
    }

    public function setSaida(?DateTimeInterface $saida): self
    {
        $this->saida = $saida;

        return $this;
    }

    public function getTempoPermanencia(): ?int
    {
        return $this->tempoPermanencia;
    }

    public function setTempoPermanencia(int $tempoPermanencia): self
    {
        $this->tempoPermanencia = $tempoPermanencia;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrou(): ?bool
    {
        return $this->entrou;
    }

    public function setEntrou(bool $entrou): self
    {
        $this->entrou = $entrou;

        return $this;
    }

    public function getSaiu(): ?bool
    {
        return $this->saiu;
    }

    public function setSaiu(bool $saiu): self
    {
        $this->saiu = $saiu;

        return $this;
    }

    public function __toString(): string
    {
        return "=========================================" . "\n" .
            "Veiculo: " . "\n" . "ID: " . $this->id . "\n" . "Tipo: " . $this->tipoVeiculo . "\n" . "Placa: " . $this->placaVeiculo .
            "\n" . "Valor da taxa: " . $this->valorTaxa . "\n" . "Horario de entrada: " . $this->formatarHora($this->entrada) .
            "\n" . "Horario de saida: " . $this->formatarHora($this->saida) . "\n" . "Entrou? " . $this->entrou .
            "\n" . "Saiu? " . $this->saiu . "\n" . "Tempo de permanencia " . $this->tempoPermanencia . "min" . "\n";
    }

    private function formatarHora(?DateTimeInterface $hora): string
    {
        return $hora !== null ? $hora->format('H:i:s') : 'null';
    }
}
