<?php

use ABA\Model\Client;

$file_client = "clients.json"; // Arquivos com a lista dos clientes
$_SESSION['tempo_update'] = 60; // Segundos

if (!file_exists($file_client) || filemtime($file_client) < (mktime() - $_SESSION['tempo_update'])) Client::updateClient();
if (!isset($_SESSION['BASECLIENTES']) || $_SESSION['BASECLIENTES'] == '') Client::listClient();

$_SESSION['ItemsPerPageGeneral'] = 20;
$_SESSION['ItemsPerPagePayDetail'] = 10;