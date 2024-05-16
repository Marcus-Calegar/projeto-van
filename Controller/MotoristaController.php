<?php

class MotoristaController
{
    private $idMotorista;
    private $nome;
    private $telefone;
    private $cpf;
    private $mensalidade;
    private $dataNascimento;
    private $email;
    private $senha;

    // Getters
    public function getIdMotorista()
    {
        return $this->idMotorista;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getMensalidade()
    {
        return $this->mensalidade;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    // Setters
    public function setIdMotorista($idMotorista)
    {
        if (!is_int($idMotorista)) {
            throw new InvalidArgumentException("Id Motorista inválido: $idMotorista");
        }
        $this->idMotorista = $idMotorista;
    }

    public function setNome($nome)
    {
        if (!is_string($nome) || empty($nome)) {
            throw new InvalidArgumentException("Nome inválido: $nome");
        }
        $this->nome = $nome;
    }

    public function setTelefone($telefone)
    {
        if (!is_string($telefone) || empty($telefone)) {
            throw new InvalidArgumentException("Telefone inválido: $telefone");
        }
        $this->telefone = $telefone;
    }

    public function setCpf($cpf)
    {
        if (!is_string($cpf) || empty($cpf)) {
            throw new InvalidArgumentException("CPF inválido: $cpf");
        }
        $this->cpf = $cpf;
    }

    public function setMensalidade($mensalidade)
    {
        if ($mensalidade < 0) {
            throw new InvalidArgumentException("Mensalidade inválida: $mensalidade");
        }
        $this->mensalidade = $mensalidade;
    }

    public function setDataNascimento($dataNascimento)
    {
        $date = DateTime::createFromFormat('Y-m-d', $dataNascimento);
        if ($date && $date->format('Y-m-d') === $dataNascimento) {
            $formattedDate = $date->format('Y-m-d'); // Formato YYYY-MM-DD para MySQL
            if (!is_string($formattedDate) || empty($formattedDate))
                throw new InvalidArgumentException("Data de nascimento inválida: $date");
        }
        $this->dataNascimento = $formattedDate;
    }

    public function setEmail($email)
    {
        if (!is_string($email) || empty($email)) {
            throw new InvalidArgumentException("Email inválido: $email");
        }
        $this->email = $email;
    }

    public function setSenha($senha)
    {
        if (empty($senha)) {
            throw new InvalidArgumentException("Senha inválida: $senha");
        }
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }
}
