<?php
include '../model/Solicitacao.php';
if (isset($_GET)) {
    $aluno = $_GET['idAluno'];
    $responsavel = $_GET['idResponsavel'];
    $motorista = $_GET['idMotorista'];

    if (Solicitacao::VerificarSolicitacoes($aluno, $responsavel, $motorista) <= 0) {

    } else {
        echo "Você já enviou uma solicitação desse aluno para este motorista.";
    }
    var_dump(Solicitacao::VerificarSolicitacoes($aluno, $responsavel, $motorista));
} else {
    header('Location: ../View/Pages/PerfilMotorista.php');
}
