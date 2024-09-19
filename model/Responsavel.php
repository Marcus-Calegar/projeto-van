<?php
require_once 'Conexoes.php';
include __DIR__ . '/../Interfaces/IUser.php';
class Responsavel implements IUser
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

            $sql = "INSERT INTO Responsavel (nome, telefone, cpf, dataNascimento, email, senha) VALUES (:nome, :telefone, :cpf, :dataNascimento, :email, :senha)";
            $stmt = $conn->preparar($sql);

            $nome = $data['nome'];
            $telefone = $data['telefone'];
            $cpf = $data['cpf'];
            $dataNascimento = self::setDataNascimento($data['dataNascimento']);
            $email = $data['email'];
            $senha = self::setSenha($data['senha']);

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
            return false;
        } finally {
            $conn = null;
        }
    }
    public static function Logar($email, $senha)
    {
        try {
            $conn = new Conexao();

            $sql = "SELECT idResponsavel, senha FROM `responsavel` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                $id = $result[0]['idResponsavel'];
                $senhaCriptografada = $result[0]['senha'];
                if (password_verify($senha, $senhaCriptografada)) {
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = 'Responsavel';
                    return true;
                }
            } else
                return false;
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
    public static function EncontrarResponsavel($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando('SELECT * FROM Responsavel WHERE idResponsavel = ' . $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }
    public function Atualizar($data)
    {
        try {
            $conn = new Conexao();

            if (isset($_POST['ModificarSenha'])) {
                $sql = "UPDATE `Responsavel` SET `nome` = :nome, `telefone` = :telefone, `cpf` = :cpf, `email` = :email, `senha` = :senha, `dataNascimento` = :dataNascimento WHERE `idResponsavel` = :id";
                $stmt = $conn->preparar($sql);
                $senha = $data['senha'];
                $stmt->bindParam(':senha', $senha);
            } else {
                $sql = "UPDATE `Responsavel` SET `nome` = :nome, `telefone` = :telefone, `cpf` = :cpf, `email` = :email, `dataNascimento` = :dataNascimento WHERE `idResponsavel` = :id";
                $stmt = $conn->preparar($sql);
            }

            $nome = $data['nome'];
            $telefone = $data['telefone'];
            $cpf = $data['cpf'];
            $dataNascimento = self::setDataNascimento($data['dataNascimento']);
            $email = $data['email'];
            $id = $data['id'];


            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        } finally {
            $conn = null;
        }
    }
    public static function ExcluirPerfil($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando('DELETE FROM Motorista WHERE idMotorista = ' . $id);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }
}
