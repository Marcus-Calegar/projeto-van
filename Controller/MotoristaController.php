<?php
include '../model/Motorista.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    switch ($action) {
        case 'inserir':
            $m = new Motorista();
            $m->Inserir($_POST);
            header('Location: ../View/Pages/Login.php');
            break;
        case 'atualizar' :
            $m = new Motorista();
            $m->Atualizar($_POST);
            header('Location: ../View/Pages/Logado.php');
            break;
        case 'excluirPerfil':
            include 'Login.php';
            if (Motorista::ExcluirPerfil($_POST['id']) != true)
                echo "Voce possui veiculos cadastrados";
            header('Location: ../View/Pages/Logado.php');
            break;
    }
}
