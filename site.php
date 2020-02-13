<?php

use ABA\Page;
use ABA\Model\Message;
use ABA\Model\Order;
use ABA\Model\Plan;
use ABA\Model\Payment;
use ABA\Model\Statistic;
use ABA\Model\Client;

//$_SESSION = array();

/*
 * ##########################################################################################
 * Páginas do Site - INICIO
 */

$app->get("/", function () {

    if (!isset($_SESSION['dtmatrix']) || $_SESSION['dtmatrix'] < mktime()) {

        $_SESSION['dtmatrix'] = (mktime() + $_SESSION['tempo_update']);
        $_SESSION['datachart'] = Statistic::indexDataChart(2019, 7);
        $alert = 0;

    } else {

        $alert = 1;

    }

    $page = new Page();

    $page->setTpl("index", [
        "datachart" => $_SESSION['datachart'],
        "alert" => $alert
    ]);

});

$app->get("/order/:page/:sort", function ($page, $sort) {

    Order::getOrder($page, $sort);

    header("Location: /$page");

    exit;

});

$app->get("/order/:page/:id/:subpage/:sort", function ($page, $id, $subpage, $sort) {

    Order::getOrder($subpage, $sort);

    header("Location: /$page/$id/$subpage");

    exit;

});


//////////////////////////////////////////////////////
///                     PLANOS                     ///
//////////////////////////////////////////////////////

$app->get("/plans", function () {

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

$app->get("/plans/create", function () {

    $page = new Page();

    $page->setTpl("plans-create", [
        "error" => Message::getError()
    ]);

});

$app->post("/plans/create", function () {

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

    Client::updateClient();

    Message::setSuccess("Registro incluído com sucesso!");

    header("Location: /plans");

    exit;

});

$app->get("/plans/:idplan/update", function ($idplan) {

    $plan = new Plan();

    $plan->get((int)$idplan);

    $page = new Page();

    $page->setTpl("plans-update", [
        "plan" => $plan->getValues(),
        "error" => Message::getError()
    ]);

});

$app->post("/plans/:idplan/update", function ($idplan) {

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

$app->get("/plans/:idplan/delete", function ($idplan) {

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

$app->get("/payments", function () {

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

$app->get("/payments/:idclient/detail", function ($idclient) {

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
            'link' => '/payments/' . $idclient . '/detail?page=' . $i,
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

$app->get("/payments/create", function () {

    $page = new Page();

    $page->setTpl("payments-create", [
        "clients" => $_SESSION['BASECLIENTES'],
        "error" => Message::getError(),
        "idclient" => "",
        "plans" => Plan::selectPlan()
    ]);

});

$app->post("/payments/create", function () {

    $payment = new Payment();

    $payment->setData($_POST);

    if ($_POST['idclient'] == '') {

        Message::setError("Selecione o CLIENTE do pagamento!");

        header("Location: /payments/create");

        exit;

    }

    if ($_POST['idplan'] == '') {

        Message::setError("Selecione o PLANO do pagamento!");

        header("Location: /payments/create");

        exit;

    }

    if ($_POST['vlrecurrence'] == '') {

        Message::setError("Selecione a RECORRÊNCIA do pagamento!");

        header("Location: /payments/create");

        exit;

    }

    if ($_POST['dtpayment'] == '') {

        Message::setError("Informe a DATA do pagamento!");

        header("Location: /payments/create");

        exit;

    }

    $payment->save();

    Message::setSuccess("Registro incluído com sucesso!");

    header("Location: /payments/create");

    exit;

});

$app->get("/payments/:idclient/create", function ($idclient) {

    $page = new Page();

    $page->setTpl("payments-create", [
        "clients" => $_SESSION['BASECLIENTES'],
        "error" => Message::getError(),
        "idclient" => $idclient,
        "plans" => Plan::selectPlan()
    ]);

});

$app->post("/payments/:idclient/create", function ($idclient) {

    $payment = new Payment();

    $payment->setData($_POST);

    if ($_POST['idplan'] == '') {

        Message::setError("Selecione o PLANO do pagamento!");

        header("Location: /payments/$idclient/create");

        exit;

    }

    if ($_POST['vlrecurrence'] == '') {

        Message::setError("Selecione a RECORRÊNCIA do pagamento!");

        header("Location: /payments/$idclient/create");

        exit;

    }

    if ($_POST['dtpayment'] == '') {

        Message::setError("Informe a DATA do pagamento!");

        header("Location: /payments/$idclient/create");

        exit;

    }

    $payment->save();

    Message::setSuccess("Registro incluído com sucesso!");

    $_SESSION['SortPayDetailByOrder'] = "DESC";
    $_SESSION['SortPayDetailByField'] = "a.idpayment";

    header("Location: /payments/$idclient/detail");

    exit;

});

$app->get("/payments/:idpayment/update", function ($idpayment) {

    $payment = new Payment();

    $payment->get((int)$idpayment);

    $page = new Page();

    $page->setTpl("payments-update", [
        "payment" => $payment->getValues(),
        "clients" => $_SESSION['BASECLIENTES'],
        "plans" => Plan::selectPlan(),
        "error" => Message::getError()
    ]);

});

$app->post("/payments/:idpayment/update", function ($idpayment) {

    $payment = new Payment();

    $payment->get((int)$idpayment);

    $payment->setData($_POST);

    if ($_POST['dtpayment'] == '') {

        Message::setError("Informe a DATA do pagamento!");

        header("Location: /payments/$idpayment/update");

        exit;

    }

    $payment->save();

    Message::setSuccess("Registro alterado com sucesso!");

    header("Location: /payments/$_POST[idclient]/detail");

    exit;

});

$app->get("/payments/:idpayment/delete", function ($idpayment) {

    $payment = new Payment();

    $payment->get((int)$idpayment);

    $idclient = $payment->getidclient();

    $payment->delete();

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

$app->get("/statistics", function () {

    if (!isset($_SESSION['dtmatrix']) || $_SESSION['dtmatrix'] < mktime()) {

        $_SESSION['dtmatrix'] = (mktime() + $_SESSION['tempo_update']);
        $_SESSION['datachart'] = Statistic::statisticsDataChart(2019, 7);
        $alert = 0;

    } else {

        $alert = 1;

    }

    $page = new Page();

    $page->setTpl("statistics", [
        "datachart" => $_SESSION['datachart'],
        "alert" => $alert
    ]);

});


//////////////////////////////////////////////////////
///                      SOBRE                     ///
//////////////////////////////////////////////////////

$app->get("/about", function () {

    $page = new Page();

    $page->setTpl("about", [
        "" => ''
    ]);

});

?>