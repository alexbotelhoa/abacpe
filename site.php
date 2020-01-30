<?php

use ABA\Page;

/*
 * ##########################################################################################
 * Páginas do Site - INICIO
 */

$app->get("/", function() {

    $page = new Page();

    $page->setTpl("index");

});

?>