<?php
require_once 'Conexoes.php';
include __DIR__ . '/../Interfaces/IUser.php';
class Aluno implements IUser
{
    public static function setDataNascimento($dataNascimento)
    {
        $date = DateTime::createFromFormat('Y-m-d', $dataNascimento);
        if ($date && $date->format('Y-m-d') === $dataNascimento)
            $formattedDate = $date->format('Y-m-d'); // Formato YYYY-MM-DD para MySQL
        return $formattedDate;
    }
    public static function setSenha($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }
    public function Inserir($data)
    {
        try {
            $conn = new Conexao();

            $sql = "INSERT INTO Aluno (nome, dataNascimento, idResponsavel, idEscola, senha, email) VALUES (:nome, :dataNascimento, :idResponsavel, :idEscola, :senha, :email)";
            $stmt = $conn->preparar($sql);

            $nome = $data['nome'];
            $dataNascimento = self::setDataNascimento($data['dataNascimento']);
            $idResponsavel = $data['idResponsavel'];
            $idEscola = $data['idEscola'];
            $senha = self::setSenha($data['senha']);
            $email = $data['email'];

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
    public static function Logar($email, $senha)
    {
        try {
            $conn = new Conexao();

            $sql = "SELECT idAluno, senha FROM `aluno` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                $id = $result[0]['idAluno'];
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
    public function ListarAlunoResponsavel($idAluno, $idResponsavel)
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

            if (isset($data['ModificarSenha'])) {
                $stmt = $conn->preparar("UPDATE Aluno SET nome = :nome, dataNascimento = :dataNascimento, idEscola = :escola, email = :email, senha = :senha WHERE idResponsavel = :idResponsavel AND idAluno = :idAluno");
                $senha = self::setSenha($data['senha']);
                $stmt->bindParam(':senha', $senha);
            } else {
                $stmt = $conn->preparar("UPDATE Aluno SET nome = :nome, dataNascimento = :dataNascimento, idEscola = :escola, email = :email WHERE idResponsavel = :idResponsavel AND idAluno = :idAluno");
            }

            $nome = $data['nome'];
            $dataNascimento = self::setDataNascimento($data['dataNascimento']);
            $escola = $data['idEscola'];
            $email = $data['email'];
            $idResponsavel = $data['idResponsavel'];
            $idAluno = $data['id'];

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
    public static function EncontrarAluno($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando('SELECT * FROM Aluno WHERE idAluno = ' . $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }
    public static function ExcluirPerfil($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando('DELETE FROM Aluno WHERE idAluno = ' . $id);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        } finally {
            $conn = null;
        }
    }
}
