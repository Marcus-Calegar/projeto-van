<?php
require_once 'Conexoes.php';

class Escola
{
    public function PesquisarEscola($Nome)
    {
        try {

            $conexao = new Conexao();
            $sql = "SELECT * FROM escola WHERE nome LIKE '%$Nome%'";
            $stmt = $conexao->comando($sql);
            $stmt->execute();
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new Exception("Nao foi possivel completar a consulta, paramentro invalido. Codigo: " . $e);
        }
    }
}
