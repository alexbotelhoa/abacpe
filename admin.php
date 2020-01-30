<?php

use ABA\PageAdmin;

/*
 * ##########################################################################################
 * Páginas do Site - INICIO
 */

$app->get("/admin", function() {

    $page = new PageAdmin();

    $page->setTpl("index");

});

$app->get("/admin2", function() {

    $page = new PageAdmin([
        "header" => false,
        "footer" => false
    ]);

    $page->setTpl("index2");

});

?>