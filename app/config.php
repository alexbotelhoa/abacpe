<?php

use SCE\Control\Client;

$_SESSION['DEMOSCE2'] = true;

$file_client = "clients.json"; // Arquivos com a lista dos clientes
$_SESSION['DIRECTORY_STATISTICS'] = "res/site/statistics/";
$_SESSION['DIRECTORY_JSON'] = "res/site/json/";
$_SESSION['tw_file_client'] = 600; // Tempo em segundos de espera para atualizar o Catálogo de Clientes
$_SESSION['tw_statistics_chart'] = 60; // Tempo em segundos de espera para dar refresh nas páginas de pesquisas

if (
    !file_exists($file_client)
    || filemtime($file_client) < (mktime() - $_SESSION['tw_file_client'])
) {
    Client::updateClient();
}
if (
    !isset($_SESSION['BASECLIENTES'])
    || $_SESSION['BASECLIENTES'] == ''
) {
    Client::listClient();
}

$_SESSION['ItemsPerPageGeneral'] = 20;
$_SESSION['ItemsPerPagePayDetail'] = 10;