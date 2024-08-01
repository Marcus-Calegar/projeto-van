<?php
require_once 'Conexoes.php';
require_once(__DIR__ . '/../Controller/AlunoController.php');
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
    public function Logar($email, $senha)
    {
        try {
            $conn = new Conexao();
            $aluno = new AlunoController();

            $sql = "SELECT idAluno, senha FROM `aluno` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                $aluno->setIdAluno($result[0]['idAluno']);
                $id = $aluno->getIdAluno();
                $senhaCriptografada = $result[0]['senha'];
                if (password_verify($senha, $senhaCriptografada)) {
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = 'Aluno';
                    return true;
                }
            }
        } catch (\Exception $e) {
            throw new $e;
        } finally {
            $conn = null;
        }
    }
    public function DeletarAluno($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando("DELETE FROM Aluno WHERE idAluno = $id");
            $stmt->execute();
        } catch (\Exception $e) {
            throw $e;
        } finally {
            $conn = null;
        }
    }
    public function MostrarAluno_Id($idAluno, $idResponsavel)
    {
        try {
            $conn = new Conexao();
            $sql = "SELECT * FROM aluno WHERE idAluno = $idAluno AND idResponsavel = $idResponsavel";
            $stmt = $conn->comando($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Exception $e) {
            throw $e;
        } finally {
            $conn = null;
        }
    }
    public function Atualizar($data)
    {
        try {
            $conn = new Conexao();
            $aluno = new AlunoController();
            if ($this->ValidarPOST($data)) {
                $aluno->setNome($data['nome']);
                $aluno->setDataNascimento($data['dataNascimento']);
                $aluno->setidResponsavel($data['idResponsavel']);
                $aluno->setIdAluno($data['idAluno']);
                $aluno->setidEscola($data['idEscola']);
                $aluno->setEmail($data['email']);
                if (isset($data['ModificarSenha']))
                    $aluno->setSenha($data['senha']);
            }
            if (isset($data['ModificarSenha'])) {
                $stmt = $conn->preparar("UPDATE Aluno SET nome = :nome, dataNascimento = :dataNascimento, idEscola = :escola, email = :email, senha = :senha WHERE idResponsavel = :idResponsavel AND idAluno = :idAluno");
                $senha = $aluno->getSenha();
                $stmt->bindParam(':senha', $senha);
            } else
                $stmt = $conn->preparar("UPDATE Aluno SET nome = :nome, dataNascimento = :dataNascimento, idEscola = :escola, email = :email WHERE idResponsavel = :idResponsavel AND idAluno = :idAluno");

            $nome = $aluno->getNome();
            $dataNascimento = $aluno->getDataNascimento();
            $escola = $aluno->getIdEscola();
            $email = $aluno->getEmail();
            $idResponsavel = $aluno->getIdResponsavel();
            $idAluno = $aluno->getIdAluno();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':idResponsavel', $idResponsavel);
            $stmt->bindParam(':idAluno', $idAluno);
            $stmt->bindParam(':escola', $escola);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        } catch (\Exception $e) {
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
        case 'deletar':
            $aluno = new Aluno();
            $aluno->DeletarAluno($_POST['idAluno']);
            header('Location: ../View/Pages/Logado.php?cod=3');
            break;
        case 'atualizar':
            $aluno = new Aluno();
            $aluno->Atualizar($_POST);
            header('Location: ../View/Pages/AreaAluno.php?Sucesso=1');
            break;
    }
}
