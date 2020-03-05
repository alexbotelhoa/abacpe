<?php

use SCE\Control\Client;

$_SESSION['DEMOSCE2'] = true;
$_SESSION['tw_file_client'] = 600; // Tempo em segundos de espera para atualizar o Catálogo de Clientes
$_SESSION['tw_statistics_chart'] = 60; // Tempo em segundos de espera para dar refresh nas páginas de pesquisas

$file = Client::pathAndFileClient();

if (!file_exists($file) || filemtime($file) < (mktime() - $_SESSION['tw_file_client'])) Client::updateClient();

if (!isset($_SESSION['BASECLIENTES']) || $_SESSION['BASECLIENTES'] == '') $_SESSION['BASECLIENTES'] = Client::listClient();

$_SESSION['ItemsPerPageGeneral'] = 20;
$_SESSION['ItemsPerPagePayDetail'] = 10;