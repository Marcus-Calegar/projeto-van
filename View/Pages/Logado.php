<?php
include "../Layout/navmenu.php";
include '../../Controller/MotoristaController.php';
$m = new MotoristaController();
echo 'Logado como: ' . $m->getEmail();
