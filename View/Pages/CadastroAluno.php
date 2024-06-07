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
</body>

</html>