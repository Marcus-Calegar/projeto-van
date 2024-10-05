<?php
include '../Layout/navmenu.php';
include_once '../../model/Escola.php';
$idEscola = $_GET['id'];

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">mensalidade</th>
                <?= '<th>Ver mais</th>'; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (Escola::PesquisarMotoristaEscola($idEscola) as $motorista):
            ?>
                <tr>
                    <td><?= $motorista['nome'] ?></td>
                    <td><?= $motorista['telefone'] ?></td>
                    <td><?= $motorista['mensalidade'] ?></td>
                    <td>
                        <?= '<a href="PerfilMotorista.php?id=' . $motorista['idMotorista'] . '">Ver Perfil</a>'; ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</body>

</html>