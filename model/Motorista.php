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
    public function Logar()
    {
        try {
            $conn = new Conexao();
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

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                $motorista->setIdMotorista($result[0]['idMotorista']);
                $senhaCriptografada = $result[0]['senha'];
                $id = $motorista->getIdMotorista();
                if (password_verify($_POST['senha'], $senhaCriptografada)) {
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
            try {
                $motorista = new Motorista();
                if ($motorista->Logar()) {
                    header('Location: ../View/Pages/Logado.php');
                } else {
                    header('Location: ../View/Pages/AreaMotoristas.php');
                }
            } catch (\Throwable $th) {
                throw $th;
            }
            break;
    }
}
