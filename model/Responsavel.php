<?php
require_once 'Conexoes.php';
require_once __DIR__ . '/../Controller/ResponsavelController.php';
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
    public function Logar($email, $senha)
    {
        try {
            $conn = new Conexao();
            $responsavel = new ResponsavelController();

            $sql = "SELECT idResponsavel, senha FROM `responsavel` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                $responsavel->setIdResponsavel($result[0]['idResponsavel']);
                $id = $responsavel->getIdResponsavel();
                $senhaCriptografada = $result[0]['senha'];
                if (password_verify($senha, $senhaCriptografada)) {
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = 'Responsavel';
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
    public function MostrarDependentes($emailLogado)
    {
        try {
            $conn = new Conexao();

            $sql = "SELECT `idAluno`, A.`nome`, A.`dataNascimento`, E.`nome` as escola, A.`senha`, A.`email` FROM `aluno` A
                    JOIN `responsavel` as R USING (idResponsavel)
                    JOIN `escola` as E USING (idEscola)
                    WHERE `R`.`email` like :email";
            $stmt = $conn->preparar($sql);
            $email = $emailLogado;
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
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
            $responsavel = new Responsavel();
            $responsavel->Inserir();
            header('Location: ../View/Pages/Logado.php?Sucesso=1');
            break;
    }
}
