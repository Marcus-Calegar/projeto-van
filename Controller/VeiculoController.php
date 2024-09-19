<?php
include '../model/Veiculo.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = isset($_POST['action']) ? $_POST['action'] : '';
    switch ($action) {
        case 'inserir':
            $veiculo = new Veiculo();
            $veiculo->Inserir($_POST);
            header('Location: ../View/Pages/Logado.php?Sucesso=1');
            break;
        case 'atualizar':
            $veiculo = new Veiculo();
            $veiculo->Atualizar($_POST);
            header('Location: ../View/Pages/Logado.php?Sucesso=1');
            break;
        case 'deletar':
            $veiculo = new Veiculo();
            $veiculo->DeletarVeiculo($_POST['idVeiculo']);
            header('Location: ../View/Pages/Logado.php?Sucesso=1');
            break;
    }
}
