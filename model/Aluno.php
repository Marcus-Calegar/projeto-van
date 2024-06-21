<?php
require_once 'Conexoes.php';
require_once '../Controller/AlunoController.php';
class Aluno
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
            $aluno = new AlunoController();
            $validar = new Aluno();

            if ($validar->ValidarPOST($_POST)) {
                $aluno->setNome($_POST['nome']);
                $aluno->setDataNascimento($_POST['dataNascimento']);
                $aluno->setSenha($_POST['senha']);
                $aluno->setEmail($_POST['email']);
                $aluno->setidEscola($_POST['idEscola']);
                $aluno->setIdResponsavel($_POST['idResponsavel']);
            } else {
                return false;
            }
            $sql = "INSERT INTO Aluno (nome, dataNascimento, idResponsavel, idEscola, senha, email) VALUES (:nome, :dataNascimento, :idResponsavel, :idEscola, :senha, :email)";
            $stmt = $conn->preparar($sql);

            $nome = $aluno->getNome();
            $dataNascimento = $aluno->getDataNascimento();
            $idResponsavel = $aluno->getIdResponsavel();
            $idEscola = $aluno->getIdEscola();
            $senha = $aluno->getSenha();
            $email = $aluno->getEmail();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':idResponsavel', $idResponsavel);
            $stmt->bindParam(':idEscola', $idEscola);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            throw $e;
        } finally {
            $conn = null;
        }
    }
    public function Logar()
    {
        try {
            $conn = new Conexao();
            $aluno = new AlunoController();
            $validar = new Aluno();
            if ($validar->ValidarPOST($_POST)) {
                $aluno->setEmail($_POST['email']);
                $aluno->setSenha($_POST['senha']);
            } else {
                return false;
            }
            $sql = "SELECT idAluno, senha FROM `aluno` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $email = $aluno->getEmail();
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $aluno->setIdAluno($result[0]['idAluno']);
            $senhaCriptografada = $result[0]['senha'];
            if ($stmt->rowCount() > 0) {
                if (password_verify($_POST['senha'], $senhaCriptografada)) {
                    return $aluno->getIdAluno();
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
            $aluno = new Aluno();
            $aluno->Inserir();
            header('Location: ../View/Pages/AreaAluno.php?Sucesso=1');
            break;
        case 'login':
            $aluno = new Aluno();
            $id = $aluno->Logar();
            $user = 'Aluno';
            if ($aluno->Logar() != false) {
                header('Location: ../View/Pages/Logado.php?ID=' . $id . '&User=' . $user);
            } else {
                header('Location: ../View/Pages/AreaAluno.php?Erro=1');
            }
            break;
    }
}
