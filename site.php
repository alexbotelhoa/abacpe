<?php

use ABA\Page;
use ABA\Model\Message;
use ABA\Model\Order;
use ABA\Model\Plan;
use ABA\Model\Payment;
use ABA\Model\Statistic;

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

$app->get("/order/:page/:sort", function($page, $sort) {

    Order::getOrder($page, $sort);

    header("Location: /$page");

    exit;

});



  //////////////////////////////////////////////////////
 ///                     PLANOS                     ///
//////////////////////////////////////////////////////

$app->get("/plans", function() {

    (!isset($_SESSION['SortPlanByField'])) ? $sort_field = $_SESSION['SortPlanByField'] = "idplan" : $sort_field = $_SESSION['SortPlanByField'];

    (!isset($_SESSION['SortPlanByOrder'])) ? $sort_order = $_SESSION['SortPlanByOrder'] = "ASC" : $sort_order = $_SESSION['SortPlanByOrder'];

    $sort = $sort_field . " " . $sort_order;

    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    $plan = new Plan();

    $pagination = $plan->getPlanPage($sort, $page);

    $pages = [];

    for ($i = 1; $i <= $pagination['pages']; $i++) {
        array_push($pages, [
            'link' => '/plans?page=' . $i,
            'page' => $i
        ]);
    }

    $page = new Page();

    $page->setTpl("plans", [
        "plan" => $pagination['data'],
        "error" => Message::getError(),
        "success" => Message::getSuccess(),
        "pages" => $pages
    ]);

});

$app->get("/plans/create", function() {

    $page = new Page();

    $page->setTpl("plans-create");

});

$app->post("/plans/create", function() {

    $plan = new Plan();

    $plan->setData($_POST);

    $plan->save();

    Message::setSuccess("Registro incluído com sucesso!");

    header("Location: /plans");

    exit;

});

$app->get("/plans/:idplan/update", function($idplan) {

    $plan = new Plan();

    $plan->get((int)$idplan);

    $page = new Page();

    $page->setTpl("plans-update", [
        "plan" => $plan->getValues()
    ]);

});

$app->post("/plans/:idplan/update", function($idplan) {

    $plan = new Plan();

    $plan->get((int)$idplan);

    $plan->setData($_POST);

    $plan->save();

    Message::setSuccess("Registro alterado com sucesso!");

    header("Location: /plans");

    exit;

});

$app->get("/plans/:idplan/delete", function($idplan) {

    $checkpayment = Plan::checkPayment($idplan);

    if (count($checkpayment) > 0) {

        Message::setError("Existe pagamento(s) vinculado(s) a esse plano!");

        header("Location: /plans");

        exit;

    }

    $plan = new Plan();

    $plan->get((int)$idplan);

    $plan->delete();

    Message::setSuccess("Registro excluído com sucesso!");

    header("Location: /plans");

    exit;

});










  //////////////////////////////////////////////////////
 ///                   PAGAMENTOS                   ///
//////////////////////////////////////////////////////

$app->get("/payments", function() {

    $page = new Page();

    $page->setTpl("payments", [
        "" => ''
    ]);

});



  //////////////////////////////////////////////////////
 ///                  ESTATISTICAS                  ///
//////////////////////////////////////////////////////

$app->get("/statistics", function() {

    $page = new Page();

    $page->setTpl("statistics", [
        "" => ''
    ]);

});



  //////////////////////////////////////////////////////
 ///                      SOBRE                     ///
//////////////////////////////////////////////////////

$app->get("/about", function() {

    $page = new Page();

    $page->setTpl("about", [
        "" => ''
    ]);

});

?>