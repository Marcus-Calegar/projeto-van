<?php
require_once 'Conexoes.php';
include __DIR__ . '/../Interfaces/IUser.php';
class Motorista implements IUser
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
      
            $sql = "INSERT INTO Motorista (nome, telefone, cpf, mensalidade, dataNascimento, email, senha) VALUES (:nome, :telefone, :cpf, :mensalidade, :dataNascimento, :email, :senha)";
            $stmt = $conn->preparar($sql);
            
            $cpf = $data['cpf'];
            $nome = $data['nome'];
            $telefone = $data['telefone'];
            $mensalidade = $data['mensalidade'];
            $dataNascimento = self::setDataNascimento($data['dataNascimento']);
            $email = $data['email'];
            $senha = self::setSenha($data['senha']);
            $idEscola = $data['idEscola'];

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':mensalidade', $mensalidade);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            $this->InserirMotoristaEscola($cpf, $idEscola);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }

    public function InserirMotoristaEscola($cpf, $idEscola){
        $conn = new Conexao();

        $stmtIdMotorista = $conn->preparar("SELECT idMotorista FROM Motorista WHERE cpf = :cpf");
        $stmtIdMotorista->bindParam(':cpf', $cpf);
        $stmtIdMotorista->execute();
        $linha = $stmtIdMotorista->fetchAll(PDO::FETCH_ASSOC);
        $idMotorista = $linha[0]['idMotorista'];
        $stmt = $conn->preparar("INSERT INTO MotoristaEscola(idMotorista, idEscola) VALUES(:idMotorista, :idEscola)");
        $stmt->bindParam(':idMotorista', $idMotorista);

        $stmt->bindParam(':idEscola', $idEscola);
        $stmt->execute();
    }

    public function Atualizar($data)
    {
        try {
            $conn = new Conexao();
            if (isset($_POST['ModificarSenha'])) {
                $sql = "UPDATE `Motorista` SET `nome` = :nome, `telefone` = :telefone, `cpf` = :cpf, `mensalidade` = :mensalidade, `dataNascimento` = :dataNascimento, `email` = :email, `senha` = :senha WHERE idMotorista = :id";
                $stmt = $conn->preparar($sql);
                $senha = self::setSenha($data['senha']);
                $stmt->bindParam(':senha', $senha);
            } else {
                $sql = "UPDATE `Motorista` SET `nome` = :nome, `telefone` = :telefone, `cpf` = :cpf, `mensalidade` = :mensalidade, `dataNascimento` = :dataNascimento, `email` = :email WHERE idMotorista = :id";
                $stmt = $conn->preparar($sql);
            }

            $nome = $data['nome'];
            $telefone = $data['telefone'];
            $cpf = $data['cpf'];
            $mensalidade = $data['mensalidade'];
            $dataNascimento = self::setDataNascimento($data['dataNascimento']);
            $email = $data['email'];
            $id = $data['id'];

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':mensalidade', $mensalidade);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }
    public static function Logar($email, $senha)
    {
        try {
            $conn = new Conexao();

            $sql = "SELECT idMotorista, senha FROM `motorista` WHERE email = :email";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                $id = $result[0]['idMotorista'];
                $senhaCriptografada = $result[0]['senha'];
                if (password_verify($senha, $senhaCriptografada)) {
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = 'Motorista';
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
    public static function EncontrarMotorista($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->preparar('SELECT * FROM Motorista WHERE idMotorista = :id');
            $stmt->bindParam(':id', $id);
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