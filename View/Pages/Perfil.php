<?php
include "../Layout/navmenu.php";

session_start();
if ($_SESSION['user'] == 'Responsavel') {
    include_once '../../model/Responsavel.php';
    $informacoes = Responsavel::EncontrarResponsavel($_SESSION['id']);
}
if ($_SESSION['user'] == 'Aluno') {
    include_once '../../model/Aluno.php';
    $informacoes = Aluno::EncontrarAluno($_SESSION['id']);
}
if ($_SESSION['user'] == 'Motorista') {
    include_once '../../model/Motorista.php';
    $informacoes = Motorista::EncontrarMotorista($_SESSION['id']);
}
$informacoes = $informacoes[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SESSION['user'] == 'Responsavel') :
    ?>
        <p>
        <h5>Nome:</h5><?= $informacoes['nome'] ?></p>
        <p>
        <h5>Cpf:</h5><?= $informacoes['cpf'] ?></p>
        <p>
        <h5>Telefone:</h5><?= $informacoes['telefone'] ?></p>
        <p>
        <h5>Data Nascimento:</h5><?= date_format(date_create($informacoes['dataNascimento']), 'd M Y') ?></p>
        <p>
        <h5>Email:</h5><?= $informacoes['email'] ?></p>
    <?php
    endif;
    if ($_SESSION['user'] == 'Aluno') :
        include_once '../../model/Escola.php';
        $NomeEscola = Escola::PesquisarEscolaPorId($informacoes['idEscola'])[0]['nome'];
    ?>
        <p>
        <h5>Nome:</h5><?= $informacoes['nome'] ?></p>
        <p>
        <h5>Data Nascimento:</h5><?= date_format(date_create($informacoes['dataNascimento']), 'd M Y') ?></p>
        <p>
        <h5>Email:</h5><?= $informacoes['email'] ?></p>
        <p>
        <h5>Escola:</h5><?= $NomeEscola ?></p>
    <?php
    endif;
    if ($_SESSION['user'] == 'Motorista') :
    ?>
        <p>
        <h5>Nome:</h5><?= $informacoes['nome'] ?></p>
        <p>
        <h5>Data Nascimento:</h5><?= date_format(date_create($informacoes['dataNascimento']), 'd M Y') ?></p>
        <p>
        <h5>Email:</h5><?= $informacoes['email'] ?></p>
        <p>
        <h5>Telefone:</h5><?= $informacoes['telefone'] ?></p>
        <p>
        <h5>CPF:</h5><?= $informacoes['cpf'] ?></p>
    <?php
    endif;
    ?>
    <div class="d-flex">
        <a href="Logado.php" class="btn btn-primary mx-2">Voltar</a>
        <a href="EditarPerfil.php" class="btn btn-warning mx-2">Editar Perfil</a>
        <form action="../../model/<?= $_SESSION['user'] ?>.php" method="post">
            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
            <input type="hidden" name="action" value="excluirPerfil">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir Perfil</button>
        </form>
    </div>
</body>

</html>