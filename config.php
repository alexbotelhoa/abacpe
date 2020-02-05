<?php

(!isset($_SESSION['BASECLIENTES'])) ? $_SESSION['BASECLIENTES'] = json_decode(file_get_contents("https://demo4417994.mockable.io/clientes/"), true) : '';

$_SESSION['ItemsPerPageGeneral'] = 20;
$_SESSION['ItemsPerPagePayDetail'] = 10;
