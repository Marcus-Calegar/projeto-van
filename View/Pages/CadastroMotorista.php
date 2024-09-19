<?php
include "../Layout/navmenu.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Motorista</title>
</head>

<body>
    <form class="mx-auto" action="/Controller/MotoristaController.php" method="post">
        <input type="text" hidden name="action" value="inserir">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Telefone</label>
            <input type="tel" class="form-control" name="telefone" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mensalidade</label>
            <input type="text" class="form-control" name="mensalidade" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" name="dataNascimento" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">CPF</label>
            <input type="text" class="form-control" name="cpf" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senha" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</body>

</html>