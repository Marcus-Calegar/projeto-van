<?php
include "View/Layout/navmenu.php";
?>
<h1 class="text-center">TELA INICIAL</h1>
<?php
if (isset($_SESSION)){
    echo "Bem vindo, " . $_SESSION['nome'];
}
?>