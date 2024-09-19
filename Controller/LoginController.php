<?php
include  '../model/Login.php';
if (!isset($_GET['LogOut'])) {
    if (isset($_POST['LogIn'])) {
        if (Login::Logar($_POST)) {
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
