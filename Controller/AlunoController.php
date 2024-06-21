<?php

class AlunoController
{
    private $idAluno;
    private $nome;
    private $dataNascimento;
    private $senha;
    private $email;
    private $idEscola;
    private $idResponsavel;

    public function getIdAluno()
    {
        return $this->idAluno;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getIdEscola()
    {
        return $this->idEscola;
    }
    public function getidResponsavel()
    {
        return $this->idResponsavel;
    }

    // Set

    public function setIdAluno($idAluno)
    {
        if (empty($idAluno)) {
            throw new InvalidArgumentException("Id do Aluno inválido: $idAluno");
        }
        $this->idAluno = $idAluno;
    }

    public function setNome($nome)
    {
        if (!is_string($nome) || empty($nome)) {
            throw new InvalidArgumentException("Nome Inválido: $nome");
        }
        $this->nome = $nome;
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
    public function setEmail($email)
    {
        if (!is_string($email) || empty($email)) {
            throw new InvalidArgumentException("Email inválido: $email");
        }
        $this->email = $email;
    }
    public function setidEscola($idEscola)
    {
        if (empty($idEscola)) {
            throw new InvalidArgumentException("Escola e inválida: $idEscola");
        }
        $this->idEscola = $idEscola;
    }
    public function setidResponsavel($idResponsavel)
    {
        if (empty($idResponsavel)) {
            throw new InvalidArgumentException("Responsavel e inválido: $idResponsavel");
        }
        $this->idResponsavel = $idResponsavel;
    }
}
