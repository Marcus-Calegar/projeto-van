<?php
include "../Layout/navmenu.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="d-flex flex-wrap justify-content-center align-items-center">
        <div class="m-5">
            <h4 class="mb-2">Entrar em uma conta</h4>
            <form class="d-flex flex-column align-items-center" action="../../model/Aluno.php" method="post">
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
    </div>
</body>

</html>