<?php

session_start();

require_once("../vendor/autoload.php");
require_once("app/config.php");
require_once("app/functions.php");

use Slim\Slim;

$app = new Slim();

$app->config('debug', true);

// CONTROLE DE PLANOS EMPRESARIAIS V2
require_once("app/Routes/site.php");

$app->run();

?>