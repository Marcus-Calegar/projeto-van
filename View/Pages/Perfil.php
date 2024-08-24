<?php
include "../Layout/navmenu.php";

session_start();
if ($_SESSION['user'] == 'Responsavel') {
    include_once '../../model/Responsavel.php';
    $responsavel = new Responsavel();
    $infomacoes = $responsavel->EncontrarResponsavel($_SESSION['id']);
}
if ($_SESSION['user'] == 'Aluno') {
    include_once '../../model/Aluno.php';
    $aluno = new Aluno();
    $infomacoes = $aluno->EncontrarAluno($_SESSION['id']);
}
if ($_SESSION['user'] == 'Motorista') {
    include_once '../../model/Motorista.php';
    $motorista = new Motorista();
    $infomacoes = $motorista->EncontrarMotorista($_SESSION['id']);
}
$infomacoes = $infomacoes[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p><h5>Nome:</h5><?= $infomacoes['nome']?></p>
    <p><h5>Cpf:</h5><?= $infomacoes['cpf']?></p>
    <p><h5>Telefone:</h5><?= $infomacoes['telefone']?></p>
    <p><h5>Data Nascimento:</h5><?= date_format(date_create($infomacoes['dataNascimento']), 'd M Y')?></p>
    <p><h5>Email:</h5><?= $infomacoes['email']?></p>
    <a href="Logado.php" class="btn btn-primary">Voltar</a>
</body>

</html>