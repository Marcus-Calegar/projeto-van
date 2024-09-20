<?php
require_once 'Conexoes.php';

class Escola
{
    public static function PesquisarEscola($Nome)
    {
        try {
            $conexao = new Conexao();
            $sql = "SELECT * FROM escola WHERE nome LIKE '%$Nome%'";
            $stmt = $conexao->comando($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new Exception("Nao foi possivel completar a consulta, paramentro invalido. Codigo: " . $e);
        } finally {
            $conexao = null;
        }
    }
    public static function PesquisarEscolaPorId($Id)
    {
        try {
            $conexao = new Conexao();
            $sql = "SELECT * FROM escola WHERE idEscola = $Id";
            $stmt = $conexao->comando($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new Exception("Nao foi possivel completar a consulta, paramentro invalido. Codigo: " . $e);
        } finally {
            $conexao = null;
        }
    }
    public static function PesquisarEscolas()
    {
        try {
            $conexao = new Conexao();
            $sql = 'SELECT * FROM escola';
            $stmt = $conexao->comando($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new Exception("Nao foi possivel completar a consulta, paramentro invalido. Codigo: " . $e);
        } finally {
            $conexao = null;
        }
    }
}
