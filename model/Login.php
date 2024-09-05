<?php
class Login
{
    public static function Logar()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if ($_POST['User'] == 'Aluno') {
            include 'Aluno.php';
            if (Aluno::Logar($email, $senha))
                return true;
        } else if ($_POST['User'] == 'Responsavel') {
            include 'Responsavel.php';
            if (Responsavel::Logar($email, $senha))
                return true;
        } else if ($_POST['User'] == 'Motorista') {
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
}
if (!isset($_GET['LogOut'])) {
    if (isset($_POST['LogIn'])) {
        if (Login::Logar()) {
            unset($_POST['LogIn']);
            $_SESSION['ativa'] = true;
            header("Location: ../View/Pages/Logado.php");
        } else {
            header("Location: ../View/Pages/Login.php");
        }
    }
} else {
    Login::LogOut();
}
