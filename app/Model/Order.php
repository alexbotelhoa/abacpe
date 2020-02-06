<?php

namespace ABA\Model;

use ABA\Model;

class Order extends Model
{

    public static function getOrder($local, $sort)
    {

        (!isset($_SESSION['LastField'])) ? $_SESSION['LastField'] = "ASC" : '';

        if ($local == "plans") {

            if ($_SESSION['LastField'] == $sort && $_SESSION['SortPlanByOrder'] == "ASC") {

                $_SESSION['SortPlanByOrder'] = "DESC";

            } else {

                $_SESSION['SortPlanByOrder'] = "ASC";

            }

            switch ($sort) {

                case "ordid":
                    $_SESSION['SortPlanByField'] = "idplan";
                    break;
                case "ordplan":
                    $_SESSION['SortPlanByField'] = "desplan";
                    break;
                case "ordvlp":
                    $_SESSION['SortPlanByField'] = "vlplan";
                    break;

            }

        }

        if ($local == "payments") {

            if ($_SESSION['LastField'] == $sort && $_SESSION['SortPaymentByOrder'] == "ASC") {

                $_SESSION['SortPaymentByOrder'] = "DESC";

            } else {

                $_SESSION['SortPaymentByOrder'] = "ASC";

            }

            switch ($sort) {

                case "ordid":
                    $_SESSION['SortPaymentByField'] = "a.idclient";
                    break;
                case "ordcli":
                    $_SESSION['SortPaymentByField'] = "a.idclient";
                    break;
                case "ordpla":
                    $_SESSION['SortPaymentByField'] = "a.idplan";
                    break;
                case "ordqtd":
                    $_SESSION['SortPaymentByField'] = "qtdpay";
                    break;

            }

        }

        if ($local == "detail") {

            if ($_SESSION['LastField'] == $sort && $_SESSION['SortPayDetailByOrder'] == "ASC") {

                $_SESSION['SortPayDetailByOrder'] = "DESC";

            } else {

                $_SESSION['SortPayDetailByOrder'] = "ASC";

            }

            switch ($sort) {

                case "ordid":
                    $_SESSION['SortPayDetailByField'] = "a.idpayment";
                    break;
                case "ordcli":
                    $_SESSION['SortPayDetailByField'] = "a.idclient";
                    break;
                case "ordpla":
                    $_SESSION['SortPayDetailByField'] = "a.idplan";
                    break;
                case "ordrec":
                    $_SESSION['SortPayDetailByField'] = "a.vlrecurrence";
                    break;
                case "orddtp":
                    $_SESSION['SortPayDetailByField'] = "a.dtpayment";
                    break;
                case "ordvlp":
                    $_SESSION['SortPayDetailByField'] = "a.vlpayment";
                    break;

            }

        }

        $_SESSION['LastField'] = $sort;

        return true;

    }

}