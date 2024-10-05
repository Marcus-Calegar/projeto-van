<?php
session_start();
include "../Layout/navmenu.php";
if (isset($_SESSION['ativa']))
    $idResponsavel = $_SESSION['id'];
$idMotorista = $_GET['id'];

include_once '../../model/Motorista.php';
include_once '../../model/Conexoes.php';

$conn = new Conexao();

$stmt = $conn->preparar('SELECT A.nome, idAluno FROM Aluno A JOIN Responsavel R USING(idResponsavel) WHERE A.idResponsavel = :idResponsavel');
$stmt->bindParam(':idResponsavel', $idResponsavel);
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$informacoes = Motorista::EncontrarMotorista($idMotorista);
$informacoes = $informacoes[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>
    <h5>Nome:</h5><?= $informacoes['nome'] ?></p>
    <p>
    <h5>Data Nascimento:</h5><?= date_format(date_create($informacoes['dataNascimento']), 'd M Y') ?></p>
    <p>
    <h5>Email:</h5><?= $informacoes['email'] ?></p>
    <p>
    <h5>Telefone:</h5><?= $informacoes['telefone'] ?></p>
    <p>
    <h5>CPF:</h5><?= $informacoes['cpf'] ?></p>
    <?php
    if (isset($_SESSION['ativa'])):
    ?>
        <form action="../../Controller/SolicitacaoController.php" method="get">
            <h3>Enviar solicitacao do aluno</h3>
            <select name="idAluno" class="form-select">
                <?php
                foreach ($alunos as $aluno):
                ?>
                    <option value="<?= $aluno['idAluno'] ?>"><?= $aluno['nome'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <input type="text" hidden name="idResponsavel" value="<?= $idResponsavel ?>">
            <input type="text" hidden name="idMotorista" value="<?= $idMotorista ?>">
            <button type="submit">Enviar Solicitacao</button>
        </form>
    <?php
    endif;
    ?>
</body>

</html>