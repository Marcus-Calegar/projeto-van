<?php

class VeiculoController
{
    private $idVeiculo;
    private $marca;
    private $modelo;
    private $ano;
    private $placa;
    private $capacidade;
    private $idMotorista;

    public function getidVeiculo()
    {
        return $this->idVeiculo;
    }
    public function getMarca()
    {
        return $this->marca;
    }
    public function getModelo()
    {
        return $this->modelo;
    }
    public function getAno()
    {
        return $this->ano;
    }
    public function getPlaca()
    {
        return $this->placa;
    }
    public function getCapacidade()
    {
        return $this->capacidade;
    }
    public function getidMotorista()
    {
        return $this->idMotorista;
    }

    public function setidVeiculo($IdVeiculo)
    {
        if (empty($IdVeiculo)) {
            throw new InvalidArgumentException("Id Veiculo inválido: $IdVeiculo");
        }
        $this->idVeiculo = $IdVeiculo;
    }
    public function setMarca($Marca)
    {
        if (!is_string($Marca) || empty($Marca)) {
            throw new InvalidArgumentException("Nome Inválido: $Marca");
        }
        $this->marca = $Marca;
    }
    public function setModelo($Modelo)
    {
        if (!is_string($Modelo) || empty($Modelo)) {
            throw new InvalidArgumentException("Nome Inválido: $Modelo");
        }
        $this->modelo = $Modelo;
    }
    public function setAno($Ano)
    {
        if (!is_numeric($Ano) || $Ano < 2000 || $Ano > 2025) {
            throw new InvalidArgumentException("Ano Inválido: $Ano");
        }
        $this->ano = $Ano;
    }
    public function setPlaca($Placa)
    {
        if (!is_string($Placa) || empty($Placa)) {
            throw new InvalidArgumentException("Placa Inválida: $Placa");
        }
        $this->placa = $Placa;
    }
    public function setIdMotorista($IdMotorista)
    {
        if (empty($IdMotorista)) {
            throw new InvalidArgumentException("Id Motorista inválido: $IdMotorista");
        }
        $this->idMotorista = $IdMotorista;
    }
    public function setCapacidade($Capacidade)
    {
        if (!is_numeric($Capacidade) || $Capacidade < 1) {
            throw new InvalidArgumentException("Capacidade Inválida: $Capacidade");
        }
        $this->capacidade = $Capacidade;
    }
}
