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
    if ($_SESSION['user'] == 'Responsavel'):
    ?>
        <form class="mx-auto" action="/model/Responsavel.php" method="post">
            <input type="text" hidden name="action" value="atualizar">
            <input type="text" hidden name="id" value="<?= $_SESSION['id'] ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?= $informacoes['nome'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Telefone</label>
                <input type="tel" class="form-control" name="telefone" value="<?= $informacoes['telefone'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="dataNascimento" value="<?= $informacoes['dataNascimento'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf" value="<?= $informacoes['cpf'] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $informacoes['email'] ?>">
            </div>
            <div class="mb-3">
                <input type="checkbox" id="ModificarSenha" name="ModificarSenha">
                <label for="ModificarSenha">Alterar Senha</label>
                <div id="DivSenha" style="display: none;">
                    <label class="form-label">Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="senha" id="Senha" disabled>
                        <button class="btn btn-outline-secondary" id="BtnMostrarSenha" type="button">Mostrar</button>
                    </div>
                </div>
            </div>
            <a href="Perfil.php" class="btn btn-primary">Voltar</a>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

    <?php
    endif;
    ?>
    <script>
        document.querySelector("#ModificarSenha").addEventListener('change', function() {
            if (this.checked) {
                document.querySelector("#DivSenha").style.display = "block";
                document.querySelector('#Senha').disabled = false;
            } else {
                document.querySelector("#DivSenha").style.display = "none";
                document.querySelector('#Senha').disabled = true;
            }
        });

        document.querySelector('#BtnMostrarSenha').addEventListener('click', function() {
            let senha = document.querySelector('#Senha');
            if (senha.type === "password") {
                senha.type = "text";
            } else {
                senha.type = "password";
            }
        });
    </script>
</body>

</html>