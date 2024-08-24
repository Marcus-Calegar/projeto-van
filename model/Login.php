<?php
class Login
{
    public function Logar()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if ($_POST['User'] == 'Aluno') {
            include 'Aluno.php';
            $a = new Aluno();
            if ($a->Logar($email, $senha))
                return true;
        } else if ($_POST['User'] == 'Responsavel') {
            include 'Responsavel.php';
            $r = new Responsavel();
            if ($r->Logar($email, $senha))
                return true;
        } else if ($_POST['User'] == 'Motorista') {
            include 'Motorista.php';
            $m = new Motorista();
            if ($m->Logar($email, $senha))
                return true;
        }
        return false;
    }
    public function LogOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
    }
}
$log = new Login();
if (!isset($_GET['LogOut'])) {
    if (isset($_POST['LogIn'])) {
        if ($log->Logar()) {
            unset($_POST['LogIn']);
            $_SESSION['ativa'] = true;
            header("Location: ../View/Pages/Logado.php");
        }
    }
} else {
    $log->LogOut();
}
