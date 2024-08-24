<?php
require_once 'Conexoes.php';
include_once dirname(__FILE__) . '/../Controller/MotoristaController.php';
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
            $motorista = new MotoristaController();

            if ($this->ValidarPOST($_POST)) {
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
    public function Logar($email, $senha)
    {
        try {
            $conn = new Conexao();
            $motorista = new MotoristaController();

            $sql = "SELECT * FROM `motorista` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                $motorista->setIdMotorista($result[0]['idMotorista']);
                $senhaCriptografada = $result[0]['senha'];
                $id = $motorista->getIdMotorista();
                if (password_verify($senha, $senhaCriptografada)) {
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = 'Motorista';
                    return true;
                }
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            throw $e;
        } finally {
            $conn = null;
        }
    }
    public function EncontrarMotorista($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando('SELECT * FROM Motorista WHERE idMotorista = ' . $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
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
            header('Location: ../View/Pages/Login.php');
            break;
    }
}
