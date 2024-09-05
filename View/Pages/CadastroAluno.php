<?php
include '../Layout/navmenu.php';
include_once '../../model/Conexoes.php';
try {
    $conn = new Conexao();
    $sql = "SELECT * FROM Escola";
    $stmt = $conn->preparar($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\PDOException $e) {
    throw $e;
} finally {
    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Aluno</title>
</head>

<body>
    <?php if (!isset($_GET['Update'])) : ?>
        <form class="mx-auto" action="/model/Aluno.php" method="POST">
            <input type="text" hidden name="action" value="inserir">
            <input type="text" hidden name="idResponsavel" value="<?= $_GET['id'] ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="dataNascimento" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Escola</label>
                <select name="idEscola" class="form-select">
                    <option></option>
                    <?php
                    foreach ($result as $value) :
                    ?>
                        <option value="<?= $value['idEscola'] ?>"><?= $value['nome'] ?></option>
                    <?php endforeach ?>
                </select>
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
        <?php
    else :
        include_once(__DIR__ . '/../../model/Aluno.php');
        $a = new Aluno();
        $aluno = $a->ListarAlunoResponsavel($_POST['idAluno'], $_POST['idResponsavel']);
        foreach ($aluno as $valor) :
        ?>
            <form class="mx-auto" action="/model/Aluno.php" method="post">
                <input type="text" hidden name="action" value="atualizar">
                <input type="text" hidden name="idResponsavel" value="<?= $_POST['idResponsavel'] ?>">
                <input type="text" hidden name="idAluno" value="<?= $_POST['idAluno'] ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" value="<?= $valor['nome'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" name="dataNascimento" aria-describedby="emailHelp" value="<?= $valor['dataNascimento'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Escola</label>
                    <select name="idEscola" class="form-select">
                        <?php
                        foreach ($result as $value) :
                            if ($value['idEscola'] == $valor['idEscola']) :
                        ?>
                                <option value="<?= $value['idEscola'] ?>" selected><?= $value['nome'] ?></option>
                            <?php else : ?>
                                <option value="<?= $value['idEscola'] ?>"><?= $value['nome'] ?></option>
                        <?php
                            endif;
                        endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $valor['email'] ?>">
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
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
    <?php
        endforeach;
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