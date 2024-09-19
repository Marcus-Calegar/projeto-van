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
    }
}
