<?php
include_once 'Conexoes.php';
class Solicitacao
{
    public function EnviarSolicitacao($idAluno, $idResponsavel, $idMotorista)
    {
        try {
            $conn = new Conexao();
            $sql = "INSERT INTO Solicitacao(idAluno, idResponsavel, idMotorista) VALUES(:idAluno, :idResponsavel, :idMotorista)";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':idAluno', $idAluno);
            $stmt->bindParam(':idResponsavel', $idResponsavel);
            $stmt->bindParam(':idMotorista', $idMotorista);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }
    public static function VerificarSolicitacoes($idAluno, $idResponsavel, $idMotorista)
    {
        try {
            $conn = new Conexao();
            $sql = "SELECT count(*) FROM `solicitacao` WHERE idResponsavel = :idResponsavel and idMotorista = :idMotorista and idAluno = :idAluno GROUP BY idResponsavel, idMotorista, idAluno";
            $stmt = $conn->preparar($sql);
            $stmt->bindParam(':idResponsavel', $idResponsavel);
            $stmt->bindParam(':idMotorista', $idMotorista);
            $stmt->bindParam(':idAluno', $idAluno);
            $stmt->execute();
            $resultadoPesquisa = $stmt->fetchAll();
            if ($resultadoPesquisa != null)
                return $resultadoPesquisa[0][0];
            else
                return 0;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn = null;
        }
    }
}
