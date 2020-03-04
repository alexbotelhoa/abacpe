<?php

namespace SCE\Control;

class Order
{
    public static function getOrder($local, $sort)
    {
        if (!isset($_SESSION['LastField'])) $_SESSION['LastField'] = "ASC";
        if (!isset($_SESSION['SortPlanByOrder'])) $_SESSION['SortPlanByOrder'] = "ASC";
        if (!isset($_SESSION['SortPaymentByOrder'])) $_SESSION['SortPaymentByOrder'] = "ASC";
        if (!isset($_SESSION['SortPayDetailByOrder'])) $_SESSION['SortPayDetailByOrder'] = "ASC";

        if ($local == "plans") {
            ($_SESSION['LastField'] == $sort && $_SESSION['SortPlanByOrder'] == "ASC") ? $order = "DESC" : $order = "ASC";

            $_SESSION['SortPlanByOrder'] = $order;

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
                default:
                    $sort = false;
            }
        }

        if ($local == "payments") {
            ($_SESSION['LastField'] == $sort && $_SESSION['SortPaymentByOrder'] == "ASC") ? $order = "DESC" : $order = "ASC";

            $_SESSION['SortPaymentByOrder'] = $order;

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
                default:
                    $sort = false;
            }
        }

        if ($local == "detail") {
            ($_SESSION['LastField'] == $sort && $_SESSION['SortPayDetailByOrder'] == "ASC") ? $order = "DESC" : $order = "ASC";

            $_SESSION['SortPayDetailByOrder'] = $order;

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
                default:
                    $sort = false;
            }
        }

        if ($sort != false) $_SESSION['LastField'] = $sort;

        (in_array($local, ['plans','payments','detail']) && $sort != false) ? $return = true : $return = false;

        return $return;
    }
}