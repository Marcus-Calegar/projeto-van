<?php
require_once 'Conexoes.php';
require_once '../Controller/ResponsavelController.php';
class Responsavel
{
    private function ValidarPOST($post)
    {
        foreach ($post as $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }
    public function Inserir()
    {
        try {
            $conn = new Conexao();
            $conn->__construct();
            $responsavel = new ResponsavelController();
            $validar = new Responsavel();

            if ($validar->ValidarPOST($_POST)) {
                $responsavel->setNome($_POST['nome']);
                $responsavel->setTelefone($_POST['telefone']);
                $responsavel->setCpf($_POST['cpf']);
                $responsavel->setEmail($_POST['email']);
                $responsavel->setSenha($_POST['senha']);
                $responsavel->setDataNascimento($_POST['dataNascimento']);
            } else {
                return false;
            }
            $sql = "INSERT INTO Responsavel (nome, telefone, cpf, dataNascimento, email, senha) VALUES (:nome, :telefone, :cpf, :dataNascimento, :email, :senha)";
            $stmt = $conn->preparar($sql);

            $nome = $responsavel->getNome();
            $telefone = $responsavel->getTelefone();
            $cpf = $responsavel->getCpf();
            $dataNascimento = $responsavel->getDataNascimento();
            $email = $responsavel->getEmail();
            $senha = $responsavel->getSenha();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    switch ($action) {
        case 'inserir':
            $responsavel = new Responsavel();
            $responsavel->Inserir();
            header('Location: ../View/Pages/AreaResponsaveis.php');
            break;
        /*case 'login':
            $responsavel = new Responsavel();
            
            if ($responsavel->Logar()) {
                header('Location: ../View/Pages/Logado.php?ID=');
            } else {
                header('Location: ../View/Pages/AreaResponsavel.php');
            }
            break; */
    }
}