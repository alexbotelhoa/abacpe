<?php

namespace ABA\Model;

use ABA\Model;
use ABA\DB\Sql;

class Statistic extends Model
{

    public static function firstPayment()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM vw_dtpayment_first");

    }

    public static function intervalPayment($year = 2019, $month = 07)
    {

        $sql = new Sql();

        $data = $sql->select("SELECT * FROM tb_payments WHERE dtpayment 
            BETWEEN ADDDATE('" . $year . "-" . $month . "-01', INTERVAL -10 MONTH) AND '" . $year . "-" . $month . "-31' ORDER BY dtpayment DESC");

        $months =       ["Ago", "Set", "Out", "Nov", "Dez", "Jan", "Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];

        $dataYearMonth = "$year-$month-01";

        $_SESSION['firstPayment'] = Statistic::firstPayment();


        // CRIANDO A MATRIZ DE PAGAMENTOS POR CLIENTE
        for ($c = 0; $c < count($_SESSION['firstPayment']); $c++) {

            for ($d = 0; $d < 10; $d++) {

                $client[$_SESSION['firstPayment'][$c]['idclient']][$d] = 0;
                $mrr[$d] = 0;
                $mrrc[$d] = 0;
                $new[$d] = 0;
                $resurrected[$d] = 0;
                $expansion[$d] = 0;
                $contration[$d] = 0;
                $cancelled[$d] = 0;

            }

        }
        // ./CRIANDO A MATRIZ DE PAGAMENTOS POR CLIENTE


        for ($x = 0; $x < count($data); $x++) {

            $vlpayment = $data[$x]['vlpayment'] / $data[$x]['vlrecurrence']; // Valor pago pelo cliente

            $firstpayment = $_SESSION['firstPayment'][$data[$x]['idclient']]['dtpayment']; // Data do primeiro pagamento do cliente

            if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-0 month", strtotime($dataYearMonth)))) { // No mês pesquisado

                $mrr[0] = $mrr[0] + $vlpayment;

                $client[$data[$x]['idclient']][0] = $vlpayment;

                ($data[$x]['dtpayment'] == $firstpayment) ? $new[0] = $new[0] + $vlpayment : "";

            } else {

                if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-1 month", strtotime($dataYearMonth)))) { // 1 mes atrás

                    $mrr[1] = $mrr[1] + $vlpayment;

                    $client[$data[$x]['idclient']][1] = $vlpayment;

                    ($data[$x]['dtpayment'] == $firstpayment) ? $new[1] = $new[1] + $vlpayment : "";

                    if (in_array($data[$x]['vlrecurrence'], array(3, 6))) {
                        $mrr[0] = $mrr[0] + $vlpayment;
                        $client[$data[$x]['idclient']][0] = $vlpayment;
                    }

                } else {

                    if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-2 month", strtotime($dataYearMonth)))) { // 2 meses atrás

                        $mrr[2] = $mrr[2] + $vlpayment;

                        ($data[$x]['dtpayment'] == $firstpayment) ? $new[2] = $new[2] + $vlpayment : "";

                        $client[$data[$x]['idclient']][2] = $vlpayment;

                        if (in_array($data[$x]['vlrecurrence'], array(3, 6))) {
                            $mrr[1] = $mrr[1] + $vlpayment;
                            $mrr[0] = $mrr[0] + $vlpayment;
                            $client[$data[$x]['idclient']][1] = $vlpayment;
                            $client[$data[$x]['idclient']][0] = $vlpayment;
                        }

                    } else {

                        if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-3 month", strtotime($dataYearMonth)))) { // 3 meses atrás

                            $mrr[3] = $mrr[3] + $vlpayment;

                            $client[$data[$x]['idclient']][3] = $vlpayment;

                            ($data[$x]['dtpayment'] == $firstpayment) ? $new[3] = $new[3] + $vlpayment : "";

                            switch ($data[$x]['vlrecurrence']) {
                                case 3:
                                    $mrr[2] = $mrr[2] + $vlpayment;
                                    $mrr[1] = $mrr[1] + $vlpayment;
                                    $client[$data[$x]['idclient']][2] = $vlpayment;
                                    $client[$data[$x]['idclient']][1] = $vlpayment;
                                    break;
                                case 6:
                                    $mrr[2] = $mrr[2] + $vlpayment;
                                    $mrr[1] = $mrr[1] + $vlpayment;
                                    $mrr[0] = $mrr[0] +$vlpayment;
                                    $client[$data[$x]['idclient']][2] = $vlpayment;
                                    $client[$data[$x]['idclient']][1] = $vlpayment;
                                    $client[$data[$x]['idclient']][0] = $vlpayment;
                                    break;
                            }

                        } else {

                            if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-4 month", strtotime($dataYearMonth)))) { // 4 meses atrás

                                $mrr[4] = $mrr[4] + $vlpayment;

                                $client[$data[$x]['idclient']][4] = $vlpayment;

                                ($data[$x]['dtpayment'] == $firstpayment) ? $new[4] = $new[4] + $vlpayment : "";

                                switch ($data[$x]['vlrecurrence']) {
                                    case 3:
                                        $mrr[3] = $mrr[3] + $vlpayment;
                                        $mrr[2] = $mrr[2] + $vlpayment;
                                        $client[$data[$x]['idclient']][3] = $vlpayment;
                                        $client[$data[$x]['idclient']][2] = $vlpayment;
                                        break;
                                    case 6:
                                        $mrr[3] = $mrr[3] + $vlpayment;
                                        $mrr[2] = $mrr[2] + $vlpayment;
                                        $mrr[1] = $mrr[1] + $vlpayment;
                                        $mrr[0] = $mrr[0] + $vlpayment;
                                        $client[$data[$x]['idclient']][3] = $vlpayment;
                                        $client[$data[$x]['idclient']][2] = $vlpayment;
                                        $client[$data[$x]['idclient']][1] = $vlpayment;
                                        $client[$data[$x]['idclient']][0] = $vlpayment;
                                        break;
                                }

                            } else {

                                if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-5 month", strtotime($dataYearMonth)))) { // 5 meses atrás

                                    $mrr[5] = $mrr[5] + $vlpayment;

                                    $client[$data[$x]['idclient']][5] = $vlpayment;

                                    ($data[$x]['dtpayment'] == $firstpayment) ? $new[5] = $new[5] + $vlpayment : "";

                                    switch ($data[$x]['vlrecurrence']) {
                                        case 3:
                                            $mrr[4] = $mrr[4] + $vlpayment;
                                            $mrr[3] = $mrr[3] + $vlpayment;
                                            $client[$data[$x]['idclient']][4] = $vlpayment;
                                            $client[$data[$x]['idclient']][3] = $vlpayment;
                                            break;
                                        case 6:
                                            $mrr[4] = $mrr[4] + $vlpayment;
                                            $mrr[3] = $mrr[3] + $vlpayment;
                                            $mrr[2] = $mrr[2] + $vlpayment;
                                            $mrr[1] = $mrr[1] + $vlpayment;
                                            $mrr[0] = $mrr[0] + $vlpayment;
                                            $client[$data[$x]['idclient']][4] = $vlpayment;
                                            $client[$data[$x]['idclient']][3] = $vlpayment;
                                            $client[$data[$x]['idclient']][2] = $vlpayment;
                                            $client[$data[$x]['idclient']][1] = $vlpayment;
                                            $client[$data[$x]['idclient']][0] = $vlpayment;
                                            break;
                                    }

                                } else {

                                    if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-6 month", strtotime($dataYearMonth)))) { // 6 meses atrás

                                        $mrr[6] = $mrr[6] + $vlpayment;

                                        $client[$data[$x]['idclient']][6] = $vlpayment;

                                        switch ($data[$x]['vlrecurrence']) {
                                            case 3:
                                                $mrr[5] = $mrr[5] + $vlpayment;
                                                $mrr[4] = $mrr[4] + $vlpayment;
                                                $client[$data[$x]['idclient']][5] = $vlpayment;
                                                $client[$data[$x]['idclient']][4] = $vlpayment;
                                                break;
                                            case 6:
                                                $mrr[5] = $mrr[5] + $vlpayment;
                                                $mrr[4] = $mrr[4] + $vlpayment;
                                                $mrr[3] = $mrr[3] + $vlpayment;
                                                $mrr[2] = $mrr[2] + $vlpayment;
                                                $mrr[1] = $mrr[1] + $vlpayment;
                                                $client[$data[$x]['idclient']][5] = $vlpayment;
                                                $client[$data[$x]['idclient']][4] = $vlpayment;
                                                $client[$data[$x]['idclient']][3] = $vlpayment;
                                                $client[$data[$x]['idclient']][2] = $vlpayment;
                                                $client[$data[$x]['idclient']][1] = $vlpayment;
                                                break;
                                        }

                                    } else {

                                        if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-7 month", strtotime($dataYearMonth)))) { // 7 meses atrás

                                            switch ($data[$x]['vlrecurrence']) {
                                                case 3:
                                                    $mrr[5] = $mrr[5] + $vlpayment;
                                                    $client[$data[$x]['idclient']][6] = $vlpayment;
                                                    $client[$data[$x]['idclient']][5] = $vlpayment;
                                                    break;
                                                case 6:
                                                    $mrr[5] = $mrr[5] + $vlpayment;
                                                    $mrr[4] = $mrr[4] + $vlpayment;
                                                    $mrr[3] = $mrr[3] + $vlpayment;
                                                    $mrr[2] = $mrr[2] + $vlpayment;
                                                    $client[$data[$x]['idclient']][6] = $vlpayment;
                                                    $client[$data[$x]['idclient']][5] = $vlpayment;
                                                    $client[$data[$x]['idclient']][4] = $vlpayment;
                                                    $client[$data[$x]['idclient']][3] = $vlpayment;
                                                    $client[$data[$x]['idclient']][2] = $vlpayment;
                                                    break;
                                            }

                                        } else {

                                            if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-8 month", strtotime($dataYearMonth)))) { // 8 meses atrás

                                                switch ($data[$x]['vlrecurrence']) {
                                                    case 6:
                                                        $mrr[5] = $mrr[5] + $vlpayment;
                                                        $mrr[4] = $mrr[4] + $vlpayment;
                                                        $mrr[3] = $mrr[3] + $vlpayment;
                                                        $client[$data[$x]['idclient']][6] = $vlpayment;
                                                        $client[$data[$x]['idclient']][5] = $vlpayment;
                                                        $client[$data[$x]['idclient']][4] = $vlpayment;
                                                        $client[$data[$x]['idclient']][3] = $vlpayment;
                                                        break;
                                                }
                                            } else {

                                                if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-9 month", strtotime($dataYearMonth)))) { // 9 meses atrás

                                                    switch ($data[$x]['vlrecurrence']) {
                                                        case 6:
                                                            $mrr[5] = $mrr[5] + $vlpayment;
                                                            $mrr[4] = $mrr[4] + $vlpayment;
                                                            $client[$data[$x]['idclient']][6] = $vlpayment;
                                                            $client[$data[$x]['idclient']][5] = $vlpayment;
                                                            $client[$data[$x]['idclient']][4] = $vlpayment;
                                                            break;
                                                    }
                                                } else {

                                                    if (date('Y-m', strtotime($data[$x]['dtpayment'])) == date('Y-m', strtotime("-10 month", strtotime($dataYearMonth)))) { // 10 meses atrás

                                                        switch ($data[$x]['vlrecurrence']) {
                                                            case 6:
                                                                $mrr[5] = $mrr[5] + $vlpayment;
                                                                $client[$data[$x]['idclient']][6] = $vlpayment;
                                                                $client[$data[$x]['idclient']][5] = $vlpayment;
                                                                break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }


        for ($c = 0; $c < count($_SESSION['firstPayment']); $c++) {

            $id = $_SESSION['firstPayment'][$c]['idclient'];

            $dt = $_SESSION['firstPayment'][$c]['dtpayment'];

            for ($d = 6; $d >= 0; $d--) {

                $mrrc[$d] = $mrrc[$d] + 1;

                // RECEITAS VARIÁVEIS DE ENTRADAS //
                ($client[$id][$d] != 0 && $client[$id][$d + 1] == 0 && $dt < $data[$id]['dtpayment']) ? $resurrected[$d] = $resurrected[$d] + $client[$id][$d] : '';

                ($client[$id][$d + 1] != 0 && $client[$id][$d] != 0 && $client[$id][$d + 1] < $client[$id][$d]) ? $expansion[$d] = $expansion[$d] + ($client[$id][$d] - $client[$id][$d + 1]) : '';

                // RECEITAS VARIÁVEIS DE SAÍDAS //
                ($client[$id][$d + 1] != 0 && $client[$id][$d] != 0 && $client[$id][$d + 1] > $client[$id][$d]) ? $contration[$d] = $contration[$d] + ($client[$id][$d + 1] - $client[$id][$d]) : '';

                ($client[$id][$d] == 0 && $client[$id][$d + 1] != 0) ? $cancelled[$d] = $cancelled[$d] + $client[$id][$d + 1] : '';

            }

        }

        //[(VAZIO = 0) , cancelled, Contration, Expansion, Resurrected, New]
        $recdetails =   [0, $cancelled[0], $contration[0], $expansion[0], $resurrected[0], $new[0]];

        $datachart = [];

        for ($x = 5; $x >= 0; $x--) {

            array_push($datachart, [
                "month" => $months[4 + $month - $x],
                "mrr" => $mrr[$x],
                "arpu" => round($mrr[$x]/$mrrc[$x],2),
                "target" => round(($mrr[$x + 1]/$mrrc[$x + 1]) * 1.05,2),
                "entradas" => $new[$x] + $resurrected[$x] + $expansion[$x],
                "saidas" => $contration[$x] + $cancelled{$x},
                "recdetails" => $recdetails[$x]
            ]);

        }

        return $datachart;

    }



  //************************************************************************************//
 //                                  FIM DOS STATICOS                                  //
//************************************************************************************//

    public function get($idclient)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM vw_firstpayment WHERE idclient = :IDCLIENT", [
            ":IDCLIENT" => $idclient
        ]);

        if (count($result) > 0) {

            $this->setData($result[0]);

        }

    }




}