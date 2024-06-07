<?php
include "../Layout/navmenu.php";
include_once '../../model/Conexoes.php';

$id = $_GET['ID'];
$tabela = $_GET['User'];

try {
    $conn = new Conexao();
    $conn->__construct();
    $sql = "SELECT * FROM {$tabela} WHERE id{$tabela} = $id";
    $stmt = $conn->preparar($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    echo "Erro ao conectar ao banco de dados";
} finally {
    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>ID: <?= $result[0]["id{$tabela}"] ?></h3>
    <h3>Nome: <?= $result[0]['nome'] ?></h3>
    <p>Voce e: <?= $tabela ?></p>
    <?php
    if ($tabela == 'Responsavel') : ?>
        <div class="text-center">
            <h2>Cadastrar Dependente</h2>
            <a href="CadastroALuno.php?id=<?= $id ?>" class="btn btn-primary">Cadastrar</a>
            <div class="table-responsive-md">
                <table class="table table-striped m-2">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Data Nascimento</th>
                            <th scope="col">Email</th>
                            <th scope="col">Escola</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../../model/Responsavel.php';
                        $responsavel = new Responsavel();
                        $emailLogado = $result[0]['email'];
                        $dependente = $responsavel->MostrarDependentes($emailLogado);

                        foreach ($dependente as $value) :
                        ?>
                            <tr>
                                <td><?= $value['nome'] ?></td>
                                <td><?= $value['dataNascimento'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['escola'] ?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
</body>

</html>