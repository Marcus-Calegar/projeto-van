<?php
include "../Layout/navmenu.php";
include_once '../../model/Conexoes.php';
include '../../model/Login.php';
session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("Location: ../../model/Login.php?LogOut=1");
$id = $_SESSION['id'];
$tabela = $_SESSION['user'];

try {
    $conn = new Conexao();
    $sql = "SELECT * FROM $tabela WHERE id{$tabela} = '$id'";
    $stmt = $conn->comando($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $th) {
    echo ('Erro ao conectar ao banco de dados ' . $th);
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
    <h3>ID: <?= $id ?></h3>
    <h3>Nome: <?= $result[0]['nome'] ?></h3>
    <p>Voce e: <?= $tabela ?></p>
    <a href="Perfil.php" class="btn btn-primary">Meu Perfil</a>
    <a class="btn btn-danger" onclick="return confirm('Tem certeza que deseja sair?')" href="../../model/Login.php?LogOut=1">Sair</a>
    <?php
    if ($tabela == 'Responsavel') : ?>
        <div class="text-center">
            <h2>Cadastrar Dependente</h2>
            <a href="CadastroALuno.php?id=<?= $id ?>" class="btn btn-primary">Cadastrar</a>
            <div class="table-responsive-md">
                <table class="table table-striped m-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data Nascimento</th>
                            <th scope="col">Email</th>
                            <th scope="col">Escola</th>
                            <th scope="col" colspan="2">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../../model/Responsavel.php';
                        $responsavel = new Responsavel();
                        $emailLogado = $result[0]['email'];
                        $dependente = $responsavel->MostrarDependentes($emailLogado);
                        if (!is_null($dependente) || !empty($dependente)) :
                            $contador = 1;
                            foreach ($dependente as $value) :
                        ?>
                                <tr>
                                    <td><?= $contador++ ?></td>
                                    <td><?= $value['nome'] ?></td>
                                    <td><?= $value['dataNascimento'] ?></td>
                                    <td><?= $value['email'] ?></td>
                                    <td><?= $value['escola'] ?></td>
                                    <td>
                                        <form action="CadastroAluno.php?Update=1" method="post">
                                            <input type="text" value="none" name="action" hidden>
                                            <input type="text" value="<?= $value['idAluno'] ?>" name="idAluno" hidden>
                                            <input type="text" value="<?= $id ?>" name="idResponsavel" hidden>
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/model/Aluno.php" method="post" onclick="return confirm('Tem certeza que deseja excluir o dependete?')">
                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </button>
                                            <input type="text" value="<?= $value['idAluno'] ?>" name="idAluno" hidden>
                                            <input type="text" value="deletar" name="action" hidden>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
    <?php if ($tabela == 'Motorista') : ?>
        <div class="text-center">
            <h2>Cadastrar Veiculo</h2>
            <form action="CadastroVeiculo.php" method="post">
                <button class="btn btn-primary" type="submit">Cadastrar</button>
                <input type="text" hidden value="<?= $id ?>" name="idMotorista">
            </form>
            <div class="table-responsive-md">
                <table class="table table-striped m-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Capacidade</th>
                            <th scope="col">Placa</th>
                            <th scope="col" colspan="2">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once(__DIR__ . '/../../model/Veiculo.php');
                        $v = new Veiculo();
                        $veiculos = $v->MostrarVeiculos($id);
                        if (!is_null($veiculos) || !empty($veiculos)) :
                            $cont = 1;
                            foreach ($veiculos as $value) :
                        ?>
                                <tr>
                                    <td><?= $cont++ ?></td>
                                    <td><?= $value['marca'] ?></td>
                                    <td><?= $value['modelo'] ?></td>
                                    <td><?= $value['ano'] ?></td>
                                    <td><?= $value['capacidade'] ?></td>
                                    <td><?= $value['placa'] ?></td>
                                    <td>
                                        <form action="CadastroVeiculo.php?Update=1" method="post">
                                            <button type="submit" class="btn btn-primary">
                                                <input type="text" value="<?= $value['idVeiculo'] ?>" name="idVeiculo" hidden>
                                                <input type="text" value="<?= $id ?>" name="idMotorista" hidden>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </button>
                                        </form>
                                        <a href="CadastroVeiculo.php?Update=1&id=<?= $id ?>">
                                        </a>
                                    </td>
                                    <td>
                                        <form action="/model/Veiculo.php" method="post" onclick="return confirm('Tem certeza que deseja excluir o veiculo?')">
                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </button>
                                            <input type="text" value="<?= $value['idVeiculo'] ?>" name="idVeiculo" hidden>
                                            <input type="text" value="deletar" name="action" hidden>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>