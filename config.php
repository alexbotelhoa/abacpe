<?php

use ABA\Model\Client;

$file_client = "clients.json"; // Arquivos com a lista dos clientes
$_SESSION['DIRECTORY_STATISTICS'] = "app" . DIRECTORY_SEPARATOR . "statistics" . DIRECTORY_SEPARATOR . "";
$_SESSION['tw_file_client'] = 600; // Tempo em segundos de espera para atualizar o Catálogo de Clientes
$_SESSION['tw_statistics_chart'] = 60; // Tempo em segundos de espera para dar refresh nas páginas de pesquisas

if (!file_exists($file_client) || filemtime($file_client) < (mktime() - $_SESSION['tw_file_client'])) Client::updateClient();
if (!isset($_SESSION['BASECLIENTES']) || $_SESSION['BASECLIENTES'] == '') Client::listClient();

$_SESSION['ItemsPerPageGeneral'] = 20;
$_SESSION['ItemsPerPagePayDetail'] = 10;