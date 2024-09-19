<?php
class Login
{
    public static function Logar($data)
    {
        $email = $data['email'];
        $senha = $data['senha'];

        if ($data['User'] == 'Aluno') {
            include 'Aluno.php';
            if (Aluno::Logar($email, $senha))
                return true;
        } else if ($data['User'] == 'Responsavel') {
            include 'Responsavel.php';
            if (Responsavel::Logar($email, $senha))
                return true;
        } else if ($data['User'] == 'Motorista') {
            include 'Motorista.php';
            if (Motorista::Logar($email, $senha))
                return true;
        }
        return false;
    }
    public static function LogOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
    }
    public static function IniciarPerfil($tabela, $id){
        try {
            $conn = new Conexao();
            $sql = "SELECT * FROM $tabela WHERE id{$tabela} = '$id'";
            $stmt = $conn->comando($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Exception $th) {
            echo ('Erro ao conectar ao banco de dados ' . $th);
        } finally {
            $conn = null;
        }
    }
}
