<?php

use SCE\Model\Plan;
use SCE\Model\Payment;
use SCE\Model\Statistic;
use SCE\Control\Page;
use SCE\Control\Order;
use SCE\Control\Client;
use SCE\Control\Message;

/*
 * ##########################################################################################
 * Páginas do Site - INICIO
 */

$app->get("/", function () {

    $year = date('Y');
    $month = date('m');
    $_SESSION['PAGE'] = 'index';

    // VERIFICA SE HÁ VALORES NAS SESSÕES GLOBAIS
    if (!isset($_SESSION['YEAR']) || $_SESSION['YEAR'] == '') {
        $_SESSION['YEAR'] = $year;
        $_SESSION['UYEAR'] = 0;
    }

    if (!isset($_SESSION['MONTH']) || $_SESSION['MONTH'] == '') {
        $_SESSION['MONTH'] = $month;
        $_SESSION['UMONTH'] = 0;
    }

    // VERIFICA AS VARIÁVEIS DA PESQUISA SOLICITADA
    if ($_SESSION['UYEAR'] == 0000 || $_SESSION['UMONTH'] == 00) {
        $alert = 2;
    } else {
        if (!isset($_SESSION['twIndex']) || $_SESSION['twIndex'] < mktime() || $_SESSION['YEAR'] != $_SESSION['UYEAR'] || $_SESSION['MONTH'] != $_SESSION['UMONTH']) {

            // FAZ A ATUALIZAÇÃO DA MATRIX DE CLIENTES E DAS MÉTRICAS SAAS DA PÁGINA INDEX
            Statistic::indexDataChart($_SESSION['YEAR'], $_SESSION['MONTH']);

            // ATUALIZAR O TIME DE ATUALIZAÇÃO
            $_SESSION['twIndex'] = (mktime() + $_SESSION['tw_statistics_chart']);

            // ARMAZENA O ANO E MES DA ÚLTIMA PESQUISA
            $_SESSION['YEAR'] = $_SESSION['UYEAR'];
            $_SESSION['MONTH'] = $_SESSION['UMONTH'];

            $alert = 0;
        } else {
            $alert = 1;
        }
    }

    $year = $_SESSION['YEAR'];
    $month = $_SESSION['MONTH'];

    $path = Statistic::pathFileStatistics();

    // VERIFICA SE O ARQUIVO MATRIX DO INTERVALO JÁ EXISTE
    if (!file_exists($path . DIRECTORY_SEPARATOR . "index-$year-$month.json")) Statistic::indexDataChart($year, $month);

    // CARREGA O ARQUVIO COM OS DADOS ESTATÍSTICOS
    $json_file = file_get_contents($path . DIRECTORY_SEPARATOR . "index-$year-$month.json");
    $datachart = json_decode($json_file, true);

    $page = new Page();
    $page->setTpl("index", [
        "datachart" => $datachart,
        "pesquisa" => 1,
        "alert" => $alert
    ]);

});

$app->post("/", function () {

    $_SESSION['UYEAR'] = $_POST['year'];
    $_SESSION['UMONTH'] = $_POST['month'];

    header("Location: " . project() . "");
    exit;

});

$app->get("/order/:page/:sort", function ($page, $sort) {

    Order::getOrder($page, $sort);

    header("Location: " . project() . "/$page");
    exit;

});

$app->get("/order/:page/:id/:subpage/:sort", function ($page, $id, $subpage, $sort) {

    Order::getOrder($subpage, $sort);

    header("Location:  " . project() . "/$page/$id/$subpage");
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
        header("Location: " . project() . "/plans/create");
        exit;
    }

    if ($_POST['vlplan'] == '') {
        Message::setError("Informe o VALOR do plano!");
        header("Location: " . project() . "/plans/create");
        exit;
    }

    if ($_SESSION['DEMOSCE2'] != true) {
        $plan->save();
    }

    Client::updateClient();

    Message::setSuccess("Registro incluído com sucesso!");

    header("Location: " . project() . "/plans");
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
        header("Location: " . project() . "/plans/$idplan/update");
        exit;
    }

    if ($_POST['vlplan'] == '') {
        Message::setError("Informe o VALOR do plano!");
        header("Location: " . project() . "/plans/$idplan/update");
        exit;
    }

    if ($_SESSION['DEMOSCE2'] != true) {
        $plan->save();
    }

    Message::setSuccess("Registro alterado com sucesso!");

    header("Location: " . project() . "/plans");
    exit;

});

$app->get("/plans/:idplan/delete", function ($idplan) {

    $checkplan = Plan::checkPlan($idplan);

    if (count($checkplan) > 0) {
        Message::setError("Existe pagamento(s) vinculado(s) a esse plano!");
        header("Location: " . project() . "/plans");
        exit;
    }

    $plan = new Plan();
    $plan->get((int)$idplan);
    if ($_SESSION['DEMOSCE2'] != true) {
        $plan->delete();
    }

    Message::setSuccess("Registro excluído com sucesso!");

    header("Location: " . project() . "/plans");
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
        } elseif ($page <= $pagination['pages'] - 2) {
            $firstpages = $page - 2;
            $lastpages = $page + 2;
        } else {
            $firstpages = $pagination['pages'] - 4;
            $lastpages = $pagination['pages'];
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
        } elseif ($page <= $pagination['pages'] - 2) {
            $firstpages = $page - 2;
            $lastpages = $page + 2;
        } else {
            $firstpages = $pagination['pages'] - 4;
            $lastpages = $pagination['pages'];
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
        header("Location: " . project() . "/payments/create");
        exit;
    }

    if ($_POST['idplan'] == '') {
        Message::setError("Selecione o PLANO do pagamento!");
        header("Location: " . project() . "/payments/create");
        exit;
    }

    if ($_POST['vlrecurrence'] == '') {
        Message::setError("Selecione a RECORRÊNCIA do pagamento!");
        header("Location: " . project() . "/payments/create");
        exit;
    }

    if ($_POST['dtpayment'] == '') {
        Message::setError("Informe a DATA do pagamento!");
        header("Location: " . project() . "/payments/create");
        exit;
    }

    if ($_SESSION['DEMOSCE2'] != true) {
        $payment->save();
    }

    Message::setSuccess("Registro incluído com sucesso!");

    header("Location: " . project() . "/payments/create");
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
        header("Location: " . project() . "/payments/$idclient/create");
        exit;
    }

    if ($_POST['vlrecurrence'] == '') {
        Message::setError("Selecione a RECORRÊNCIA do pagamento!");
        header("Location: " . project() . "/payments/$idclient/create");
        exit;
    }

    if ($_POST['dtpayment'] == '') {
        Message::setError("Informe a DATA do pagamento!");
        header("Location: " . project() . "/payments/$idclient/create");
        exit;
    }

    if ($_SESSION['DEMOSCE2'] != true) {
        $payment->save();
    }

    Message::setSuccess("Registro incluído com sucesso!");

    $_SESSION['SortPayDetailByOrder'] = "DESC";
    $_SESSION['SortPayDetailByField'] = "a.idpayment";

    header("Location: " . project() . "/payments/$idclient/detail");
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
        header("Location: " . project() . "/payments/$idpayment/update");
        exit;
    }

    if ($_SESSION['DEMOSCE2'] != true) {
        $payment->save();
    }

    Message::setSuccess("Registro alterado com sucesso!");

    header("Location: " . project() . "/payments/$_POST[idclient]/detail");
    exit;

});

$app->get("/payments/:idpayment/delete", function ($idpayment) {

    $payment = new Payment();
    $payment->get((int)$idpayment);
    $idclient = $payment->getidclient();
    if ($_SESSION['DEMOSCE2'] != true) {
        $payment->delete();
    }

    Message::setSuccess("Registro excluído com sucesso!");

    $checkpayment = Payment::checkPayment($idclient);
    if (count($checkpayment) > 0) {
        header("Location: " . project() . "/payments/$idclient/detail");
    } else {
        header("Location: " . project() . "/payments");
    }

    exit;

});


//////////////////////////////////////////////////////
///                  ESTATISTICAS                  ///
//////////////////////////////////////////////////////

$app->get("/statistics", function ($year = 2019, $month = 07) {

    $year = date('Y');
    $month = date('m');
    $_SESSION['PAGE'] = 'statistics';

    // VERIFICA SE HÁ VALORES NAS SESSÕES GLOBAIS
    if (!isset($_SESSION['YEAR']) || $_SESSION['YEAR'] == '') {
        $_SESSION['YEAR'] = $year;
        $_SESSION['UYEAR'] = 0;
    }
    if (!isset($_SESSION['MONTH']) || $_SESSION['MONTH'] == '') {
        $_SESSION['MONTH'] = $month;
        $_SESSION['UMONTH'] = 0;
    }

    // VERIFICA AS VARIÁVEIS DA PESQUISA SOLICITADA
    if ($_SESSION['UYEAR'] == 0000 || $_SESSION['UMONTH'] == 00) {
        $alert = 2;
    } elseif (!isset($_SESSION['twStatistic']) || $_SESSION['twStatistic'] < mktime() || $_SESSION['YEAR'] != $_SESSION['UYEAR'] || $_SESSION['MONTH'] != $_SESSION['UMONTH']) {

        // FAZ A ATUALIZAÇÃO DA MATRIX DE CLIENTES E DAS MÉTRICAS SAAS DA PÁGINA ESTATISTICAS
        Statistic::statisticsDataChart($_SESSION['YEAR'], $_SESSION['MONTH']);

        // ATUALIZAR O TIME DE ATUALIZAÇÃO
        $_SESSION['twStatistic'] = (mktime() + $_SESSION['tw_statistics_chart']);

        // ARMAZENA O ANO E MES DA ÚLTIMA PESQUISA
        $_SESSION['YEAR'] = $_SESSION['UYEAR'];
        $_SESSION['MONTH'] = $_SESSION['UMONTH'];

        $alert = 0;
    } else {
        $alert = 1;
    }

    $year = $_SESSION['YEAR'];
    $month = $_SESSION['MONTH'];

    $path = Statistic::pathFileStatistics();

    // VERIFICA SE O ARQUIVO MATRIX DO INTERVALO JÁ EXISTE
    if (!file_exists($path . DIRECTORY_SEPARATOR . "statistics-$year-$month.json")) {
        Statistic::statisticsDataChart($year, $month);
    }

    // CARREGA O ARQUVIO COM OS DADOS ESTATÍSTICOS
    $json_file = file_get_contents($path . DIRECTORY_SEPARATOR . "statistics-$year-$month.json");
    $datachart = json_decode($json_file, true);

    $page = new Page();
    $page->setTpl("statistics", [
        "datachart" => $datachart,
        "alert" => $alert
    ]);

});

$app->post("/statistics", function () {

    $_SESSION['UYEAR'] = $_POST['year'];
    $_SESSION['UMONTH'] = $_POST['month'];

    header("Location: " . project() . "/statistics");
    exit;

});


//////////////////////////////////////////////////////
///                      SOBRE                     ///
//////////////////////////////////////////////////////

$app->get("/about", function () {

    if (isset($_SESSION['YEAR'])) {
        unset($_SESSION['YEAR']);
    }
    if (isset($_SESSION['MONTH'])) {
        unset($_SESSION['MONTH']);
    }

    $page = new Page();
    $page->setTpl("about");

});

?>