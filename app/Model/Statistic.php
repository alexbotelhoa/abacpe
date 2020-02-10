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

    public static function matrixPayments($year, $month)
    {

        // MONTANDO A DATA DA PESQUISA
        $dataYearMonth = "$year-$month-01";

        $sql = new Sql();

        $payment = $sql->select("SELECT * FROM tb_payments WHERE dtpayment 
            BETWEEN ADDDATE('" . $year . "-" . $month . "-01', INTERVAL -11 MONTH) AND '" . $year . "-" . $month . "-31' ORDER BY dtpayment DESC");

        // ARMAZENANDO OS CLIENTES  E SEUS PRIMEIROS PAGAMENTOS
        $clients = Statistic::firstPayment();

        // CRIANDO UMA MATRIZ VAZIA DE PAGAMENTOS DOS CLIENTES
        for ($c = 0; $c < count($clients); $c++) {

            for ($d = 0; $d < 8; $d++) {

                $matrix[$clients[$c]['idclient']][$d]['dtpayment'] = 0;
                $matrix[$clients[$c]['idclient']][$d]['vlpayment'] = 0;

            }

        }

        // POPULACIONANDO A MATRIZ DE PAGAMENTOS DOS CLIENTES
        for ($p = 0; $p < count($payment); $p++) {

            // ID DO CLIENTE
            $id = $payment[$p]['idclient'];

            // VALOR DO PAGAMENTO
            $vlpayment = $payment[$p]['vlpayment'] / $payment[$p]['vlrecurrence'];

            // DATA DO PAGAMENTO
            $dtpayment = $payment[$p]['dtpayment'];

            if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-0 month", strtotime($dataYearMonth)))) { // No mês pesquisado

                $matrix[$id][0]['dtpayment'] = $dtpayment;
                $matrix[$id][0]['vlpayment'] = $vlpayment;

            } else {

                if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-1 month", strtotime($dataYearMonth)))) { // 1 mes atrás

                    $matrix[$id][1]['dtpayment'] = $dtpayment;
                    $matrix[$id][1]['vlpayment'] = $vlpayment;


                    if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                        $matrix[$id][0]['dtpayment'] = $dtpayment;
                        $matrix[$id][0]['vlpayment'] = $vlpayment;
                    }

                } else {

                    if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-2 month", strtotime($dataYearMonth)))) { // 2 meses atrás

                        $matrix[$id][2]['dtpayment'] = $dtpayment;
                        $matrix[$id][2]['vlpayment'] = $vlpayment;

                        if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                            $matrix[$id][1]['dtpayment'] = $dtpayment;
                            $matrix[$id][1]['vlpayment'] = $vlpayment;
                            $matrix[$id][0]['dtpayment'] = $dtpayment;
                            $matrix[$id][0]['vlpayment'] = $vlpayment;
                        }

                    } else {

                        if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-3 month", strtotime($dataYearMonth)))) { // 3 meses atrás

                            $matrix[$id][3]['dtpayment'] = $dtpayment;
                            $matrix[$id][3]['vlpayment'] = $vlpayment;

                            if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                                $matrix[$id][2]['dtpayment'] = $dtpayment;
                                $matrix[$id][2]['vlpayment'] = $vlpayment;
                                $matrix[$id][1]['dtpayment'] = $dtpayment;
                                $matrix[$id][1]['vlpayment'] = $vlpayment;
                            }

                            if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                $matrix[$id][0]['dtpayment'] = $dtpayment;
                                $matrix[$id][0]['vlpayment'] = $vlpayment;
                            }

                        } else {

                            if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-4 month", strtotime($dataYearMonth)))) { // 4 meses atrás

                                $matrix[$id][4]['dtpayment'] = $dtpayment;
                                $matrix[$id][4]['vlpayment'] = $vlpayment;

                                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                                    $matrix[$id][3]['dtpayment'] = $dtpayment;
                                    $matrix[$id][3]['vlpayment'] = $vlpayment;
                                    $matrix[$id][2]['dtpayment'] = $dtpayment;
                                    $matrix[$id][2]['vlpayment'] = $vlpayment;
                                }

                                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                    $matrix[$id][1]['dtpayment'] = $dtpayment;
                                    $matrix[$id][1]['vlpayment'] = $vlpayment;
                                    $matrix[$id][0]['dtpayment'] = $dtpayment;
                                    $matrix[$id][0]['vlpayment'] = $vlpayment;
                                }

                            } else {

                                if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-5 month", strtotime($dataYearMonth)))) { // 5 meses atrás

                                    $matrix[$id][5]['dtpayment'] = $dtpayment;
                                    $matrix[$id][5]['vlpayment'] = $vlpayment;

                                    if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                                        $matrix[$id][4]['dtpayment'] = $dtpayment;
                                        $matrix[$id][4]['vlpayment'] = $vlpayment;
                                        $matrix[$id][3]['dtpayment'] = $dtpayment;
                                        $matrix[$id][3]['vlpayment'] = $vlpayment;
                                    }

                                    if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                        $matrix[$id][2]['dtpayment'] = $dtpayment;
                                        $matrix[$id][2]['vlpayment'] = $vlpayment;
                                        $matrix[$id][1]['dtpayment'] = $dtpayment;
                                        $matrix[$id][1]['vlpayment'] = $vlpayment;
                                        $matrix[$id][0]['dtpayment'] = $dtpayment;
                                        $matrix[$id][0]['vlpayment'] = $vlpayment;
                                    }

                                } else {

                                    if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-6 month", strtotime($dataYearMonth)))) { // 6 meses atrás

                                        $matrix[$id][6]['dtpayment'] = $dtpayment;
                                        $matrix[$id][6]['vlpayment'] = $vlpayment;

                                        if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                                            $matrix[$id][5]['dtpayment'] = $dtpayment;
                                            $matrix[$id][5]['vlpayment'] = $vlpayment;
                                            $matrix[$id][4]['dtpayment'] = $dtpayment;
                                            $matrix[$id][4]['vlpayment'] = $vlpayment;
                                        }

                                        if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                            $matrix[$id][3]['dtpayment'] = $dtpayment;
                                            $matrix[$id][3]['vlpayment'] = $vlpayment;
                                            $matrix[$id][2]['dtpayment'] = $dtpayment;
                                            $matrix[$id][2]['vlpayment'] = $vlpayment;
                                            $matrix[$id][1]['dtpayment'] = $dtpayment;
                                            $matrix[$id][1]['vlpayment'] = $vlpayment;
                                        }

                                    } else {

                                        if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-7 month", strtotime($dataYearMonth)))) { // 7 meses atrás

                                            if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                                                $matrix[$id][6]['dtpayment'] = $dtpayment;
                                                $matrix[$id][6]['vlpayment'] = $vlpayment;
                                                $matrix[$id][5]['dtpayment'] = $dtpayment;
                                                $matrix[$id][5]['vlpayment'] = $vlpayment;
                                            }

                                            if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                                $matrix[$id][4]['dtpayment'] = $dtpayment;
                                                $matrix[$id][4]['vlpayment'] = $vlpayment;
                                                $matrix[$id][3]['dtpayment'] = $dtpayment;
                                                $matrix[$id][3]['vlpayment'] = $vlpayment;
                                                $matrix[$id][2]['dtpayment'] = $dtpayment;
                                                $matrix[$id][2]['vlpayment'] = $vlpayment;
                                            }

                                        } else {

                                            if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-8 month", strtotime($dataYearMonth)))) { // 8 meses atrás

                                                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                                                    $matrix[$id][6]['dtpayment'] = $dtpayment;
                                                    $matrix[$id][6]['vlpayment'] = $vlpayment;
                                                }

                                                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                                    $matrix[$id][5]['dtpayment'] = $dtpayment;
                                                    $matrix[$id][5]['vlpayment'] = $vlpayment;
                                                    $matrix[$id][4]['dtpayment'] = $dtpayment;
                                                    $matrix[$id][4]['vlpayment'] = $vlpayment;
                                                    $matrix[$id][3]['dtpayment'] = $dtpayment;
                                                    $matrix[$id][3]['vlpayment'] = $vlpayment;
                                                }

                                            } else {

                                                if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-9 month", strtotime($dataYearMonth)))) { // 9 meses atrás

                                                    if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                                        $matrix[$id][6]['dtpayment'] = $dtpayment;
                                                        $matrix[$id][6]['vlpayment'] = $vlpayment;
                                                        $matrix[$id][5]['dtpayment'] = $dtpayment;
                                                        $matrix[$id][5]['vlpayment'] = $vlpayment;
                                                        $matrix[$id][4]['dtpayment'] = $dtpayment;
                                                        $matrix[$id][4]['vlpayment'] = $vlpayment;
                                                    }

                                                } else {

                                                    if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-10 month", strtotime($dataYearMonth)))) { // 10 meses atrás

                                                        if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                                            $matrix[$id][6]['dtpayment'] = $dtpayment;
                                                            $matrix[$id][6]['vlpayment'] = $vlpayment;
                                                            $matrix[$id][5]['dtpayment'] = $dtpayment;
                                                            $matrix[$id][5]['vlpayment'] = $vlpayment;
                                                        }

                                                    } else {

                                                        if (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-11 month", strtotime($dataYearMonth)))) { // 11 meses atrás

                                                            if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                                                                $matrix[$id][6]['dtpayment'] = $dtpayment;
                                                                $matrix[$id][6]['vlpayment'] = $vlpayment;
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
        }

        // CRIANDO A MATRIZ VAZIA DAS ESTATÍSTICAS SAAS
        for ($d = 0; $d < 8; $d++) {
            $mrr[$d] = 0;
            $mrrc[$d] = 0;
            $new[$d] = 0;
            $resurrected[$d] = 0;
            $expansion[$d] = 0;
            $contraction[$d] = 0;
            $cancelled[$d] = 0;
        }

        // CALCULANDO AS MÉTRICAS SAAS
        for ($c = 0; $c < count($matrix); $c++) {

            // ID DO CLIENTE
            $id = $clients[$c]['idclient'];

            // PRIMEIRO PAGAMENTO
            $firstpayment = $clients[$c]['dtpayment'];

            for ($d = 0; $d < 7; $d++) {

                // DATA DO PAGAMENTO ATUAL
                $dtpayment = $matrix[$id][$d]['dtpayment'];

                // VALOR DO PAGAMENTO ATUAL
                $vlpayment = $matrix[$id][$d]['vlpayment'];

                // VALOR DO PAGAMENTO ANTERIOR
                $agopayment = $matrix[$id][$d + 1]['vlpayment'];

                // RECEITAS VARIÁVEIS DE ENTRADAS
                ($vlpayment != 0) ? $mrr[$d] = $mrr[$d] + $vlpayment AND $mrrc[$d] = $mrrc[$d] + 1 : '';

                ($vlpayment != 0 && $dtpayment == $firstpayment) ? $new[$d] = $new[$d] + $vlpayment : '';

                ($vlpayment != 0 && $agopayment == 0 && $dtpayment > $firstpayment) ? $resurrected[$d] = $resurrected[$d] + $vlpayment : '';

                ($vlpayment != 0 && $agopayment != 0 && $vlpayment > $agopayment) ? $expansion[$d] = $expansion[$d] + ($vlpayment - $agopayment) : '';

                // RECEITAS VARIÁVEIS DE SAÍDAS
                ($vlpayment != 0 && $agopayment != 0 && $vlpayment < $agopayment) ? $contraction[$d] = $contraction[$d] + ($agopayment - $vlpayment) : '';

                ($vlpayment == 0 && $agopayment != 0) ? $cancelled[$d] = $cancelled[$d] + $agopayment : '';

            }

        }

        $data = [];

        for ($x = 0; $x < 7; $x++) {

            array_push($data, [
                "month" => date('M/y', strtotime("-$x month", strtotime($dataYearMonth))),
                "mrr" => $mrr[$x],
                "mrrc" => $mrrc[$x],
                "new" => $new[$x],
                "resurrected" => $resurrected[$x],
                "expansion" => $expansion{$x},
                "contraction" => $contraction{$x},
                "cancelled" => $cancelled[$x]
            ]);

        }

        return $data;

    }

    public static function indexDataChart($year, $month)
    {

        $matrix = Statistic::matrixPayments($year, $month);

        // ORDEM DAS ESTATÍSTICAS SAAS
        // [(VAZIO = 0) , MRR Cancelled, MRR Contraction, MRR Expansion, MRR Resurrected, MRR New]
        $f = 0;
        $recdetails =   [0, $matrix[$f]['cancelled'], $matrix[$f]['contraction'], $matrix[$f]['expansion'], $matrix[$f]['resurrected'], $matrix[$f]['new']];

        $datachart = [];

        $saas = [10, 20, 30, 40, 50, 60];

        for ($x = 5; $x >= 0; $x--) {

            array_push($datachart, [
                "month" => $matrix[$x]['month'],
                "saas" => $saas[$x],
                "mrr" => $matrix[$x]['mrr'],
                "recorrentes" => $matrix[$x]['mrr'] - ($matrix[$x]['new'] + $matrix[$x]['resurrected'] + $matrix[$x]['expansion']),
                "arpu" => ($matrix[$x]['mrrc'] > 0) ? round($matrix[$x]['mrr'] / $matrix[$x]['mrrc'], 2) : $matrix[$x]['mrr'],
                "entradas" => $matrix[$x]['new'] + $matrix[$x]['resurrected'] + $matrix[$x]['expansion'],
                "saidas" => $matrix[$x]['contraction'] + $matrix{$x}['cancelled'],
                "recdetails" => $recdetails[$x]
            ]);

        }

/*
        array_push($datachart, [
            "saas" => [10, 20, 30, 40, 50, 60]
        ]);
*/

        return $datachart;

    }

    /*
    public static function indexDataChart($year, $month)
    {

        $data = Statistic::matrixPayments($year, $month);

        // ORDEM DAS ESTATÍSTICAS SAAS
        // [(VAZIO = 0) , MRR Cancelled, MRR Contraction, MRR Expansion, MRR Resurrected, MRR New]
        $recdetails =   [0, $data[0]['cancelled'], $data[0]['contraction'], $data[0]['expansion'], $data[0]['resurrected'], $data[0]['new']];

        $datachart = [];

        for ($x = 5; $x >= 0; $x--) {

            array_push($datachart, [
                "month" => $data[$x]['month'],
                "mrr" => $data[$x]['mrr'],
                "arpu" => round($data[$x]['mrr']/$data[$x]['mrrc'],2),
                "target" => round(($data[$x + 1]['mrr']/$data[$x + 1]['mrrc']) * 1.05,2),
                "entradas" => $data[$x]['new'] + $data[$x]['resurrected'] + $data[$x]['expansion'],
                "saidas" => $data[$x]['contraction'] + $data{$x}['cancelled'],
                "recdetails" => $recdetails[$x]
            ]);

        }

        return $datachart;

    }
    */



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