<?php

class ResponsavelController
{
    private $idResponsavel;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;
    private $dataNascimento;
    private $senha;

    public function getIdResponsavel()
    {
        return $this->idResponsavel;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    // Set

    public function setIdResponsavel($idResponsavel)
    {
        if (empty($idResponsavel)) {
            throw new InvalidArgumentException("Id Responsável inválido: $idResponsavel");
        }
        $this->idResponsavel = $idResponsavel;
    }

    public function setNome($nome)
    {
        if (!is_string($nome) || empty($nome)) {
            throw new InvalidArgumentException("Nome Inválido: $nome");
        }
        $this->nome = $nome;
    }

    public function setCpf($cpf)
    {
        if (!is_string($cpf) || empty($cpf)) {
            throw new InvalidArgumentException("CPF inválido: $cpf");
        }
        $this->cpf = $cpf;
    }

    public function setTelefone($telefone)
    {
        if (!is_string($telefone) || empty($telefone)) {
            throw new InvalidArgumentException("Telefone inválido: $telefone");
        }
        $this->telefone = $telefone;
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
}
