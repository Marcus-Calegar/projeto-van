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
            <form class="d-flex flex-column align-items-center" action="/Controller/LoginController.php" method="post">
                <div class="mb-3">
                    <select class="form-select" id="cmbUsers">
                        <option selected>Tipo de usuario</option>
                        <option value="Aluno">Aluno</option>
                        <option value="Responsavel">Responsavel</option>
                        <option value="Motorista">Motorista</option>
                    </select>
                </div>
                <input type="text" name="User" id="UserType" required hidden>
                <input type="text" name="LogIn" value="LogIn" hidden>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input required type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("cmbUsers").addEventListener("change", function() {
            var selectedValue = this.value;
            if (selectedValue == "Aluno") {
                document.getElementById("exampleInputEmail1").placeholder = "Email do Aluno";
                document.getElementById("UserType").value = "Aluno";
            } else if (selectedValue == "Responsavel") {
                document.getElementById("exampleInputEmail1").placeholder = "Email do Responsavel";
                document.getElementById("UserType").value = "Responsavel";
            } else if (selectedValue == "Motorista") {
                document.getElementById("exampleInputEmail1").placeholder = "Email do Motorista";
                document.getElementById("UserType").value = "Motorista";
            } else {
                document.getElementById("exampleInputEmail1").placeholder = "Email";
                document.getElementById("UserType").value = null;
            }
        });
    </script>
</body>

</html>