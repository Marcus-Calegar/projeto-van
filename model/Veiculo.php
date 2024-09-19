<?php
require_once 'Conexoes.php';
class Veiculo
{
    public function Inserir($data)
    {
        try {
            $conn = new Conexao();

            $stmt = $conn->preparar("INSERT INTO Veiculo (placa, modelo, capacidade, ano, marca, idMotorista) VALUES (:placa, :modelo, :capacidade, :ano, :marca, :idMotorista)");
            $placa = $data['placa'];
            $modelo = $data['modelo'];
            $capacidade = $data['capacidade'];
            $ano = $data['ano'];
            $marca = $data['marca'];
            $idMotorista = $data['idMotorista'];

            $stmt->bindParam(':placa', $placa);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':capacidade', $capacidade);
            $stmt->bindParam(':ano', $ano);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':idMotorista', $idMotorista);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            throw "Erro ao conectar ao banco de dados: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    }
    public function Atualizar($data)
    {
        try {
            $conn = new Conexao();

            $stmt = $conn->preparar("UPDATE Veiculo SET marca = :marca, placa = :placa, modelo = :modelo, capacidade = :capacidade, ano = :ano WHERE idMotorista = :idMotorista AND idVeiculo = :idVeiculo");
            $marca = $data['marca'];
            $placa = $data['placa'];
            $modelo = $data['modelo'];
            $capacidade = $data['capacidade'];
            $ano = $data['ano'];
            $idMotorista = $data['idMotorista'];
            $idVeiculo = $data['idVeiculo'];

            $stmt->bindParam(':placa', $placa);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':capacidade', $capacidade);
            $stmt->bindParam(':ano', $ano);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':idMotorista', $idMotorista);
            $stmt->bindParam(':idVeiculo', $idVeiculo);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw "Erro ao conectar ao banco de dados: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    }
    public function MostrarVeiculos($idMotorista)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando("SELECT * FROM veiculo WHERE idMotorista = $idMotorista");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                return $result;
            }
        } catch (\PDOException $e) {
            throw "Erro ao conectar ao banco de dados: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    }
    public function MostrarVeiculos_idVeic($idMotorista, $idVeiculo)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando("SELECT * FROM veiculo WHERE idMotorista = $idMotorista AND idVeiculo = $idVeiculo");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                return $result;
            }
        } catch (\PDOException $e) {
            throw "Erro ao conectar ao banco de dados: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    }

    public function DeletarVeiculo($id)
    {
        try {
            $conn = new Conexao();
            $stmt = $conn->comando("DELETE FROM veiculo WHERE idVeiculo = $id");
            $stmt->execute();
        } catch (\Exception $e) {
            throw $e;
        } finally {
            $conn = null;
        }
    }
}
