<?php
require_once 'Conexoes.php';
require_once(__DIR__ . '../../Controller/VeiculoController.php');
class Veiculo
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
            $veiculo = new VeiculoController();
            if ($this->ValidarPOST($_POST)) {
                $veiculo->setMarca($_POST['marca']);
                $veiculo->setModelo($_POST['modelo']);
                $veiculo->setAno($_POST['ano']);
                $veiculo->setPlaca($_POST['placa']);
                $veiculo->setCapacidade($_POST['capacidade']);
                $veiculo->setIdMotorista($_POST['idMotorista']);
            } else {
                return false;
            }
            $stmt = $conn->preparar("INSERT INTO Veiculo (placa, modelo, capacidade, ano, marca, idMotorista) VALUES (:placa, :modelo, :capacidade, :ano, :marca, :idMotorista)");
            $placa = $veiculo->getPlaca();
            $modelo = $veiculo->getModelo();
            $capacidade = $veiculo->getCapacidade();
            $ano = $veiculo->getAno();
            $marca = $veiculo->getMarca();
            $idMotorista = $veiculo->getIdMotorista();

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
    public function Atualizar()
    {
        try {
            $conn = new Conexao();
            $veiculo = new VeiculoController();
            if ($this->ValidarPOST($_POST)) {
                $veiculo->setMarca($_POST['marca']);
                $veiculo->setPlaca($_POST['placa']);
                $veiculo->setModelo($_POST['modelo']);
                $veiculo->setCapacidade($_POST['capacidade']);
                $veiculo->setAno($_POST['ano']);
                $veiculo->setIdMotorista($_POST['idMotorista']);
                $veiculo->setidVeiculo($_POST['idVeiculo']);
            }
            $stmt = $conn->preparar("UPDATE Veiculo SET marca = :marca, placa = :placa, modelo = :modelo, capacidade = :capacidade, ano = :ano WHERE idMotorista = :idMotorista AND idVeiculo = :idVeiculo");
            $marca = $veiculo->getMarca();
            $placa = $veiculo->getPlaca();
            $modelo = $veiculo->getModelo();
            $capacidade = $veiculo->getCapacidade();
            $ano = $veiculo->getAno();
            $idMotorista = $veiculo->getidMotorista();
            $idVeiculo = $veiculo->getidVeiculo();

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
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : '';
    switch ($action) {
        case 'inserir':
            $veiculo = new Veiculo();
            $veiculo->Inserir();
            header('Location: ../View/Pages/AreaMotoristas.php?cod=1');
            break;
        case 'atualizar':
            $veiculo = new Veiculo();
            $veiculo->Atualizar();
            header('Location: ../View/Pages/AreaMotoristas.php?cod=2');
            break;
    }
}
