<?php
var_dump($_POST);
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
}

$log = new Login();
if ($log->Logar()) {
    header("Location: ../View/Pages/Logado.php");
} else {
    header("Location: ../index.php");
}
