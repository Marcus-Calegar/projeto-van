<?php
include "../Layout/navmenu.php";
include_once "../../model/Escola.php";
$escola = new Escola();

$escolas = $escola->PesquisarEscola($_GET['escola']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolas</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Escola</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($escolas as $value) :
            ?>
                <tr>
                    <th scope="row"><?= $value['idEscola'] ?></th>
                    <td><?= $value['nome'] ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</body>

</html>