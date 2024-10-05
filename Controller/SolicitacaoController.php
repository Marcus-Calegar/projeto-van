<?php
include '../model/Solicitacao.php';
if (isset($_GET)) {
    $aluno = $_GET['idAluno'];
    $responsavel = $_GET['idResponsavel'];
    $motorista = $_GET['idMotorista'];

    if (Solicitacao::VerificarSolicitacoes($aluno, $responsavel, $motorista) <= 0) {
        $enviar = new Solicitacao();
        if ($enviar->EnviarSolicitacao($aluno, $responsavel, $motorista) == true)
            echo "Solicitação enviada com sucesso!";
    } else {
        echo "Você já enviou uma solicitação desse aluno para este motorista.";
        echo '</br>
                <a href="../View/Pages/Logado.php">Voltar</a>';
    }
} else {
    header('Location: ../View/Pages/PerfilMotorista.php');
}
