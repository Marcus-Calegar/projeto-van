<?php
require_once 'Conexoes.php';
require_once '../Controller/MotoristaController.php';
class Motorista
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
            $motorista = new MotoristaController();
            $validar = new Motorista();

            if ($validar->ValidarPOST($_POST)) {
                $motorista->setNome($_POST['nome']);
                $motorista->setTelefone($_POST['telefone']);
                $motorista->setCpf($_POST['cpf']);
                $motorista->setMensalidade($_POST['mensalidade']);
                $motorista->setDataNascimento($_POST['dataNascimento']);
                $motorista->setEmail($_POST['email']);
                $motorista->setSenha($_POST['senha']);
            } else {
                return false;
            }
            $sql = "INSERT INTO Motorista (nome, telefone, cpf, mensalidade, dataNascimento, email, senha) VALUES (:nome, :telefone, :cpf, :mensalidade, :dataNascimento, :email, :senha)";
            $stmt = $conn->preparar($sql);

            $nome = $motorista->getNome();
            $telefone = $motorista->getTelefone();
            $cpf = $motorista->getCpf();
            $mensalidade = $motorista->getMensalidade();
            $dataNascimento = $motorista->getDataNascimento();
            $email = $motorista->getEmail();
            $senha = $motorista->getSenha();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':mensalidade', $mensalidade);
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
    public function Logar()
    {
        try {
            $conn = new Conexao();
            $conn->__construct();
            $motorista = new MotoristaController();
            $validar = new Motorista();
            if ($validar->ValidarPOST($_POST)) {
                $motorista->setEmail($_POST['email']);
                $motorista->setSenha($_POST['senha']);
            } else {
                return false;
            }

            $sql = "SELECT * FROM `motorista` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $email = $motorista->getEmail();
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $senhaCriptografada = $result[0]['senha'];
            $motorista->setIdMotorista($result[0]['idMotorista']);
            if ($stmt->rowCount() > 0) {
                if (password_verify($_POST['senha'], $senhaCriptografada)) {
                    return true;
                }
            } else {
                return false;
            }
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
            $motorista = new Motorista();
            $motorista->Inserir();
            header('Location: ../View/Pages/AreaMotoristas.php');
            break;
        case 'login':
            $motorista = new Motorista();
            $motoristaController = new MotoristaController();
            $conn = new Conexao();

            $motoristaController->setEmail($_POST['email']);
            $sql = "SELECT * FROM `motorista` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $email = $motoristaController->getEmail();
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $conn = null;

            $id = $result[0]['idMotorista'];
            $user = 'Motorista';
            if ($motorista->Logar()) {
                header('Location: ../View/Pages/Logado.php?ID=' . $id . '&User=' . $user);
            } else {
                header('Location: ../View/Pages/AreaMotoristas.php');
            }
            break;
    }
}
