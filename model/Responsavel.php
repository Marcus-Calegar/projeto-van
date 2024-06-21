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
    public function Logar()
    {
        try {
            $conn = new Conexao();
            $responsavel = new ResponsavelController();
            $validar = new Responsavel();
            if ($validar->ValidarPOST($_POST)) {
                $responsavel->setEmail($_POST['email']);
                $responsavel->setSenha($_POST['senha']);
            } else {
                return false;
            }
            $sql = "SELECT idResponsavel, senha FROM `responsavel` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $email = $responsavel->getEmail();
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $responsavel->setIdResponsavel($result[0]['idResponsavel']);

            $senhaCriptografada = $result[0]['senha'];

            if ($stmt->rowCount() > 0) {
                if (password_verify($_POST['senha'], $senhaCriptografada)) {
                    return $responsavel->getIdResponsavel();
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
            header('Location: ../View/Pages/AreaResponsaveis.php?Sucesso=1');
            break;
        case 'login':
            $responsavel = new Responsavel();
            $id = $responsavel->Logar();
            $user = 'Responsavel';
            if ($responsavel->Logar() != false) {
                header('Location: ../View/Pages/Logado.php?ID=' . $id . '&User=' . $user);
            } else {
                header('Location: ../View/Pages/AreaResponsaveis.php?Erro=1');
            }
            break;
    }
}
