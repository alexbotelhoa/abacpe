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

        if ($local == "tasks") {

            if ($_SESSION['LastField'] == $sort && $_SESSION['SortTaskByOrder'] == "ASC") {

                $_SESSION['SortTaskByOrder'] = "DESC";

            } else {

                $_SESSION['SortTaskByOrder'] = "ASC";

            }

            switch ($sort) {

                case "ordid":
                    $_SESSION['SortTaskByField'] = "idtask";
                    break;
                case "ordtask":
                    $_SESSION['SortTaskByField'] = "destask";
                    break;
                case "ordproj":
                    $_SESSION['SortTaskByField'] = "desproject";
                    break;
                case "ordini":
                    $_SESSION['SortTaskByField'] = "a.dtstart";
                    break;
                case "ordfim":
                    $_SESSION['SortTaskByField'] = "a.dtfinish";
                    break;
                case "ordsit":
                    $_SESSION['SortTaskByField'] = "sttask";
                    break;

            }

        }

        if ($local == "status") {

            if ($_SESSION['LastField'] == $sort) {

                if ($_SESSION['LastField'][0] == 's') {

                    ($_SESSION['SortLateByOrder'] == "ASC") ? $_SESSION['SortLateByOrder'] = "DESC" : $_SESSION['SortLateByOrder'] = "ASC";

                } else if ($_SESSION['LastField'][0] == 'n') {

                    ($_SESSION['SortNotLateByOrder'] == "ASC") ? $_SESSION['SortNotLateByOrder'] = "DESC" : $_SESSION['SortNotLateByOrder'] = "ASC";

                };

            };

            switch ($sort) {

                case "sordid":
                    $_SESSION['SortLateByField'] = "idproject";
                    break;
                case "sordproj":
                    $_SESSION['SortLateByField'] = "desproject";
                    break;
                case "sordini":
                    $_SESSION['SortLateByField'] = "dtstart";
                    break;
                case "sordfim":
                    $_SESSION['SortLateByField'] = "dtfinish";
                    break;
                case "sordrate":
                    $_SESSION['SortLateByField'] = "rtproject";
                    break;
                case "nordid":
                    $_SESSION['SortNotLateByField'] = "idproject";
                    break;
                case "nordproj":
                    $_SESSION['SortNotLateByField'] = "desproject";
                    break;
                case "nordini":
                    $_SESSION['SortNotLateByField'] = "dtstart";
                    break;
                case "nordfim":
                    $_SESSION['SortNotLateByField'] = "dtfinish";
                    break;
                case "nordrate":
                    $_SESSION['SortNotLateByField'] = "rtproject";
                    break;

            }

        }

        $_SESSION['LastField'] = $sort;

        return true;

    }

}