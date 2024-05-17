<?php
include "../Layout/navmenu.php";
include '../../Controller/MotoristaController.php';
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
    <h3>Nome: <?php echo $result[0]['nome'] ?></h3>
    <p>Voce e: <?= $tabela?></p>
</body>

</html>