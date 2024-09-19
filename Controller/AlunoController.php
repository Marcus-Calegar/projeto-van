<?php
include_once '../model/Aluno.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    switch ($action) {
        case 'inserir':
            $aluno = new Aluno();
            $aluno->Inserir($_POST);
            header('Location: ../View/Pages/Logado.php?Sucesso=1');
            break;
        case 'atualizar':
            $aluno = new Aluno();
            $aluno->Atualizar($_POST);
            header('Location: ../View/Pages/Logado.php?Sucesso=1');
            break;
        case 'deletar':
            $aluno = new Aluno();
            $aluno->DeletarAluno($_POST['idAluno']);
            header('Location: ../View/Pages/Logado.php?cod=3');
            break;
        case 'excluirPerfil':
            include 'Login.php';
            if (Aluno::ExcluirPerfil($_POST['id']) != true)
                echo "Nao foi possivel excluir";
            header('Location: ../index.php');
            Login::LogOut();
            break;
    }
}
