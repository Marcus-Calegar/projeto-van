<?php
include '../model/Responsavel.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    switch ($action) {
        case 'inserir':
            $responsavel = new Responsavel();
            $responsavel->Inserir($_POST);
            header('Location: ../View/Pages/Login.php');
            break;
        case 'atualizar':
            $responsavel = new Responsavel();
            $responsavel->Atualizar($_POST);
            header('Location: ../View/Pages/Logado.php');
            break;
        case 'excluirPerfil':
            include __DIR__ . '/../model/Login.php';
            if (Responsavel::ExcluirPerfil($_POST['id']) != true) {
                header('Location: ../View/Pages/Logado.php');
            } else
                Login::LogOut();
            break;
    }
}
