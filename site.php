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

$app->get("/order/:page/:id/:subpage/:sort", function($page, $id, $subpage, $sort) {

    Order::getOrder($subpage, $sort);

    header("Location: /$page/$id/$subpage");

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

    $pagination = $plan->getPlanPage($sort, $page, $_SESSION['ItemsPerPageGeneral']);

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
        "success" => Message::getSuccess(),
        "pages" => $pages
    ]);

});

$app->get("/plans/create", function() {

    $page = new Page();

    $page->setTpl("plans-create", [
        "error" => Message::getError()
    ]);

});

$app->post("/plans/create", function() {

    $plan = new Plan();

    $plan->setData($_POST);

    if ($_POST['desplan'] == '') {

        Message::setError("Informe o NOME do plano!");

        header("Location: /plans/create");

        exit;

    }

    if ($_POST['vlplan'] == '') {

        Message::setError("Informe o VALOR do plano!");

        header("Location: /plans/create");

        exit;

    }

    $plan->save();

    Message::setSuccess("Registro incluído com sucesso!");

    header("Location: /plans");

    exit;

});

$app->get("/plans/:idplan/update", function($idplan) {

    $plan = new Plan();

    $plan->get((int)$idplan);

    var_dump($plan->getValues()); exit;

    $page = new Page();

    $page->setTpl("plans-update", [
        "plan" => $plan->getValues(),
        "error" => Message::getError()
    ]);

});

$app->post("/plans/:idplan/update", function($idplan) {

    $plan = new Plan();

    $plan->get((int)$idplan);

    $plan->setData($_POST);


    if ($_POST['desplan'] == '') {

        Message::setError("Informe o NOME do plano!");

        header("Location: /plans/$idplan/update");

        exit;

    }

    if ($_POST['vlplan'] == '') {

        Message::setError("Informe o VALOR do plano!");

        header("Location: /plans/$idplan/update");

        exit;

    }

    $plan->save();

    Message::setSuccess("Registro alterado com sucesso!");

    header("Location: /plans");

    exit;

});

$app->get("/plans/:idplan/delete", function($idplan) {

    $checkplan = Plan::checkPlan($idplan);

    if (count($checkplan) > 0) {

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

    (!isset($_SESSION['SortPaymentByField'])) ? $sort_field = $_SESSION['SortPaymentByField'] = "idpayment" : $sort_field = $_SESSION['SortPaymentByField'];

    (!isset($_SESSION['SortPaymentByOrder'])) ? $sort_order = $_SESSION['SortPaymentByOrder'] = "ASC" : $sort_order = $_SESSION['SortPaymentByOrder'];

    $sort = $sort_field . " " . $sort_order;

    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    $payment = new Payment();

    $pagination = $payment->getPaymentPage($sort, $page, $_SESSION['ItemsPerPageGeneral']);

    $pages = [];

    if ($pagination['pages'] > 5) {

            if ($page <= 3) {

                $firstpages = 1;
                $lastpages = 5;

            } else {

                if ($page <= $pagination['pages'] - 2) {

                    $firstpages = $page - 2;
                    $lastpages = $page + 2;

                } else {

                    $firstpages = $pagination['pages'] - 4;
                    $lastpages = $pagination['pages'];

                }

            }

    } else {

        $firstpages = 1;
        $lastpages = $pagination['pages'];

    }

    for ($i = $firstpages; $i <= $lastpages; $i++) {
        array_push($pages, [
            'link' => '/payments?page=' . $i,
            'page' => $i
        ]);
    }

    $page = new Page();

    $page->setTpl("payments", [
        "payment" => $pagination['data'],
        "success" => Message::getSuccess(),
        "pages" => $pages,
        "lastpage" => (int)$pagination['pages']
    ]);

});

$app->get("/payments/:idclient/detail", function($idclient) {

    (!isset($_SESSION['SortPayDetailByField'])) ? $sort_field = $_SESSION['SortPayDetailByField'] = "idpayment" : $sort_field = $_SESSION['SortPayDetailByField'];

    (!isset($_SESSION['SortPayDetailByOrder'])) ? $sort_order = $_SESSION['SortPayDetailByOrder'] = "ASC" : $sort_order = $_SESSION['SortPayDetailByOrder'];

    $sort = $sort_field . " " . $sort_order;

    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    $payment = new Payment();

    $pagination = $payment->getPaymentClientPage($sort, $idclient, $page, $_SESSION['ItemsPerPagePayDetail']);

    $pages = [];

    if ($pagination['pages'] > 5) {

        if ($page <= 3) {

            $firstpages = 1;
            $lastpages = 5;

        } else {

            if ($page <= $pagination['pages'] - 2) {

                $firstpages = $page - 2;
                $lastpages = $page + 2;

            } else {

                $firstpages = $pagination['pages'] - 4;
                $lastpages = $pagination['pages'];

            }

        }

    } else {

        $firstpages = 1;
        $lastpages = $pagination['pages'];

    }

    for ($i = $firstpages; $i <= $lastpages; $i++) {
        array_push($pages, [
            'link' => '/payments/'. $idclient .'/detail?page=' . $i,
            'page' => $i
        ]);
    }


    $page = new Page();

    $page->setTpl("payments-detail", [
        "payment" => $pagination['data'],
        "success" => Message::getSuccess(),
        "idclient" => $idclient,
        "pages" => $pages,
        "lastpage" => (int)$pagination['pages']
    ]);

});

$app->get("/payments/:idclient/create", function($idclient) {

    $page = new Page();

    $page->setTpl("payments-create", [
        "clients" => $_SESSION['BASECLIENTES'],
        "error" => Message::getError(),
        "idclient" => $idclient,
        "plans" => Plan::listAll()
    ]);

});

$app->post("/payments/:idclient/create", function($idclient) {

    $payment = new Payment();

    $payment->setData($_POST);

    if ($_POST['dtpayment'] == '') {

        Message::setError("Informe a DATA do pagamento!");

        header("Location: /payments/$idclient/create");

        exit;

    }

    //$payment->save();

    Message::setSuccess("Registro incluído com sucesso!");

    $_SESSION['SortPayDetailByOrder'] = "DESC";
    $_SESSION['SortPayDetailByField'] = "a.idpayment";

    header("Location: /payments/$idclient/detail");

    exit;

});

$app->get("/payments/:idpayment/update", function($idpayment) {

    $payment = new Payment();

    $payment->get((int)$idpayment);

    $page = new Page();

    $page->setTpl("payments-update", [
        "payment" => $payment->getValues(),
        "clients" => $_SESSION['BASECLIENTES'],
        "plans" => Plan::listAll(),
        "error" => Message::getError()
    ]);

});

$app->post("/payments/:idpayment/update", function($idpayment) {

    $payment = new Payment();

    $payment->get((int)$idpayment);

    $payment->setData($_POST);

    if ($_POST['dtpayment'] == '') {

        Message::setError("Informe a DATA do pagamento!");

        header("Location: /payments/$idpayment/update");

        exit;

    }

    //$payment->save();

    Message::setSuccess("Registro alterado com sucesso!");

    header("Location: /payments/$_POST[idclient]/detail");

    exit;

});

$app->get("/payments/:idpayment/delete", function($idpayment) {

    $payment = new Payment();

    $payment->get((int)$idpayment);

    $idclient = $payment->getidclient();

    //$payment->delete();

    Message::setSuccess("Registro excluído com sucesso!");

    $checkpayment = Payment::checkPayment($idclient);

    if (count($checkpayment) > 0) {

        header("Location: /payments/$idclient/detail");

    } else {

        header("Location: /payments");

    }

    exit;

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