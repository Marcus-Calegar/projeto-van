<?php
include "../Layout/navmenu.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Responsável</title>
</head>

<style>
    body {
        height: 85vh;
    }

    body>div {
        height: 100%;
    }
</style>

<body>
    <div class="d-flex flex-wrap justify-content-center align-items-center">
        <div class="m-5">
            <h4 class="mb-2">Entrar em uma conta</h4>
            <form class="d-flex flex-column align-items-center" action="/model/Responsavel.php" method="POST">
                <input type="text" hidden name="action" value="login">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        <div class="m-5">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <h4 class="mb-3">Criar uma conta</h4>
                <a href="/View/Pages/CadastroResponsavel.php" class="btn btn-primary">Cadastrar-se</a>
            </div>
        </div>
    </div>
</body>

</html>