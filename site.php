<?php

use ABA\Page;

/*
 * ##########################################################################################
 * Páginas do Site - INICIO
 */

$app->get("/", function() {

    $month = ["Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Ago"];
    $mrr = [1056555, 1058600, 1056642, 1065598, 1069311, 1062444, 1066114];
    $arpu = [231.29, 232.61, 232.33, 232.51, 233.27, 232.03, 232.07];
    $target = [200, 210, 220, 230, 240, 250, 260];
    $entradas = [48621, 55680, 53303, 55956, 48931, 47927, 52830];
    $saidas = [52034, 53635, 55261, 47000, 45218, 54794, 49160];
    $recdetails = [0, 6220, 49736, 8719, 38281, 0, 0];

    $datachart = [];

    for ($x = 0; $x < 7; $x++) {

        array_push($datachart, [
            "month" => $month[$x],
            "mrr" => $mrr[$x],
            "arpu" => $arpu[$x],
            "target" => $target[$x],
            "entradas" => $entradas[$x],
            "saidas" => $saidas[$x],
            "recdetails" => $recdetails[$x]
        ]);

    }

    //var_dump($datachart); exit;

    $page = new Page();

    $page->setTpl("index", [
        "datachart" => $datachart
    ]);

});

?>