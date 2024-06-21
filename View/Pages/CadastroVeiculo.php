<?php
include "../Layout/navmenu.php";
include_once '../../model/Conexoes.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadsatro Veiculo</title>
</head>

<body>
    <?php if (!isset($_GET['Update'])) : ?>
        <form class="mx-auto" action="/model/Veiculo.php" method="post">
            <input type="text" hidden name="action" value="inserir">
            <input type="text" hidden name="idMotorista" value="<?= $_GET['id'] ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Marca</label>
                <input type="text" class="form-control" name="marca" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ano</label>
                <input type="number" class="form-control" name="ano" aria-describedby="emailHelp" min="2000" max="2024" maxlength="4" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Capacidade</label>
                <input type="number" class="form-control" name="capacidade" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Placa</label>
                <input type="text" class="form-control" name="placa" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
    else :
        include_once(__DIR__ . '/../../model/Veiculo.php');
        $v = new Veiculo();
        $veiculo = $v->MostrarVeiculos_idVeic($_GET['id'], $_POST['idVeiculo']);
        foreach ($veiculo as $value) :
        ?>
            <form class="mx-auto" action="/model/Veiculo.php" method="post">
                <input type="text" hidden name="action" value="atualizar">
                <input type="text" hidden name="idMotorista" value="<?= $_GET['id'] ?>">
                <input type="text" hidden name="idVeiculo" value="<?= $_POST['idVeiculo'] ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Marca</label>
                    <input type="text" class="form-control" name="marca" aria-describedby="emailHelp" required value="<?= $value['marca']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Modelo</label>
                    <input type="text" class="form-control" name="modelo" aria-describedby="emailHelp" required value="<?= $value['modelo']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Ano</label>
                    <input type="number" class="form-control" name="ano" aria-describedby="emailHelp" min="2000" max="2024" maxlength="4" required value="<?= $value['ano']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Capacidade</label>
                    <input type="number" class="form-control" name="capacidade" aria-describedby="emailHelp" required value="<?= $value['capacidade']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Placa</label>
                    <input type="text" class="form-control" name="placa" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?= $value['placa']?>">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
    <?php
        endforeach;
    endif;
    ?>
</body>

</html>