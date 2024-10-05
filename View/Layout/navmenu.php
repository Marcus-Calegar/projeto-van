<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar bg-body-tertiary fixed-top position-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">Projeto Van</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/index.php">Pagina inicial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Suporte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/View/Pages/Login.php">Login</a>
                        </li>
                        <?php
                        if (isset($_SESSION['ativa'])):
                            echo '<li class="nav-item">
                            <a class="nav-link" href="/View/Pages/Logado.php">Perfil</a>
                        </li>';
                        endif;
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Area de cadastro
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/View/Pages/CadastroMotorista.php">Motoristas</a></li>
                                <li><a class="dropdown-item" href="/View/Pages/CadastroResponsavel.php">Responsável</a></li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <h5>Pesquisar escolas</h5>
                    <form class="d-flex mt-3" method="get" action="/View/Pages/Escolas.php" role="search">
                        <input class="form-control me-2" type="search" placeholder="Pesquisar..." aria-label="Search" name="escola">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>