<?php

namespace SCE\Control;

class Order
{
    public static function getOrder($local, $sort)
    {
        $field = $sort;
        $order = $local;

        if (!isset($_SESSION['LastField'])) {
            $_SESSION['LastField'] = "ASC";
        }
        if (!isset($_SESSION['SortPlanByOrder'])) {
            $_SESSION['SortPlanByOrder'] = "ASC";
        }
        if (!isset($_SESSION['SortPaymentByOrder'])) {
            $_SESSION['SortPaymentByOrder'] = "ASC";
        }
        if (!isset($_SESSION['SortPayDetailByOrder'])) {
            $_SESSION['SortPayDetailByOrder'] = "ASC";
        }

        if ($local == "plans") {
            if ($_SESSION['LastField'] == $sort && $_SESSION['SortPlanByOrder'] == "ASC") {
                $order = $_SESSION['SortPlanByOrder'] = "DESC";
            } else {
                $order = $_SESSION['SortPlanByOrder'] = "ASC";
            }

            switch ($sort) {
                case "ordid":
                    $field = $_SESSION['SortPlanByField'] = "idplan";
                    break;
                case "ordplan":
                    $field = $_SESSION['SortPlanByField'] = "desplan";
                    break;
                case "ordvlp":
                    $field = $_SESSION['SortPlanByField'] = "vlplan";
                    break;
            }
        }

        if ($local == "payments") {
            if ($_SESSION['LastField'] == $sort && $_SESSION['SortPaymentByOrder'] == "ASC") {
                $order = $_SESSION['SortPaymentByOrder'] = "DESC";
            } else {
                $order = $_SESSION['SortPaymentByOrder'] = "ASC";
            }

            switch ($sort) {
                case "ordid":
                    $field = $_SESSION['SortPaymentByField'] = "a.idclient";
                    break;
                case "ordcli":
                    $field = $_SESSION['SortPaymentByField'] = "a.idclient";
                    break;
                case "ordpla":
                    $field = $_SESSION['SortPaymentByField'] = "a.idplan";
                    break;
                case "ordqtd":
                    $field = $_SESSION['SortPaymentByField'] = "qtdpay";
                    break;
            }
        }

        if ($local == "detail") {
            if ($_SESSION['LastField'] == $sort && $_SESSION['SortPayDetailByOrder'] == "ASC") {
                $order = $_SESSION['SortPayDetailByOrder'] = "DESC";
            } else {
                $order = $_SESSION['SortPayDetailByOrder'] = "ASC";
            }

            switch ($sort) {
                case "ordid":
                    $field = $_SESSION['SortPayDetailByField'] = "a.idpayment";
                    break;
                case "ordcli":
                    $field = $_SESSION['SortPayDetailByField'] = "a.idclient";
                    break;
                case "ordpla":
                    $field = $_SESSION['SortPayDetailByField'] = "a.idplan";
                    break;
                case "ordrec":
                    $field = $_SESSION['SortPayDetailByField'] = "a.vlrecurrence";
                    break;
                case "orddtp":
                    $field = $_SESSION['SortPayDetailByField'] = "a.dtpayment";
                    break;
                case "ordvlp":
                    $field = $_SESSION['SortPayDetailByField'] = "a.vlpayment";
                    break;
            }
        }

        $_SESSION['LastField'] = $sort;

        return $field . " " . $order;
    }
}