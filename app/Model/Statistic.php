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

    public static function salePlan($year, $month)
    {

        $sql = new Sql();

        return $sql->select("SELECT idplan, date_format(dtpayment, '%Y-%m') AS YearMonth, count(*) AS qtdplan
            FROM tb_payments
            WHERE dtpayment BETWEEN ADDDATE('" . $year . "-" . $month . "-01', INTERVAL -5 MONTH) AND '" . $year . "-" . $month . "-31'
            GROUP BY idplan, YearMonth ORDER BY idplan ASC, YearMonth DESC");

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

            for ($d = 0; $d < 7; $d++) {

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
        for ($d = 0; $d < 6; $d++) {
            $mrr[$d] = 0;
            $mrrc[$d] = 0;
            $new[$d] = 0;
            $resurrected[$d] = 0;
            $expansion[$d] = 0;
            $contraction[$d] = 0;
            $cancelled[$d] = 0;
            $cancelledc[$d] = 0;
        }


        // CALCULANDO AS MÉTRICAS SAAS
        for ($c = 0; $c < count($matrix); $c++) {

            // ID DO CLIENTE
            $id = $clients[$c]['idclient'];

            // PRIMEIRO PAGAMENTO
            $firstpayment = $clients[$c]['dtpayment'];

            for ($d = 0; $d < 6; $d++) {

                // DATA DO PAGAMENTO ATUAL
                $dtpayment = $matrix[$id][$d]['dtpayment'];

                // VALOR DO PAGAMENTO ATUAL
                $vlpayment = $matrix[$id][$d]['vlpayment'];

                // VALOR DO PAGAMENTO ANTERIOR
                $agopayment = $matrix[$id][$d + 1]['vlpayment'];

                // RECEITAS VARIÁVEIS DE ENTRADAS
                if ($vlpayment != 0) {$mrr[$d] += $vlpayment; $mrrc[$d]++;}

                if ($vlpayment != 0 && $dtpayment == $firstpayment) $new[$d] += $vlpayment;

                if ($vlpayment != 0 && $agopayment == 0 && $dtpayment > $firstpayment) $resurrected[$d] += $vlpayment;

                if ($vlpayment != 0 && $agopayment != 0 && $vlpayment > $agopayment) $expansion[$d] += ($vlpayment - $agopayment);

                // RECEITAS VARIÁVEIS DE SAÍDAS
                if ($vlpayment != 0 && $agopayment != 0 && $vlpayment < $agopayment) $contraction[$d] += ($agopayment - $vlpayment);

                if ($vlpayment == 0 && $agopayment != 0) {$cancelled[$d] += $agopayment; $cancelledc[$d]++;}

            }

        }


        // DEVOLVENDO AS MÉTRICAS PARAMETRIZADA
        $datachart = [];

        for ($x = 0; $x < 6; $x++) {
            array_push($datachart, [
                "month" => date('M/y', strtotime("-$x month", strtotime($dataYearMonth))),
                "mrr" => $mrr[$x],
                "mrrc" => $mrrc[$x],
                "new" => $new[$x],
                "resurrected" => $resurrected[$x],
                "expansion" => $expansion{$x},
                "contraction" => $contraction{$x},
                "cancelled" => $cancelled[$x],
                "cancelledc" => $cancelledc[$x]
            ]);
        }

        return $datachart;

    }

    public static function indexDataChart($year, $month)
    {

        // CHAMANDO A MATRIZ DE PAGAMENTOS
        $matrix = Statistic::matrixPayments(2019,07);


        // MONTANDO OS VALORES E PERCENTUAIS DAS MÉTRICAS SAAS
        $pernew = round(($matrix[0]['new'] * 100) / $matrix[0]['mrr'], 1);
        $perexpansion = round(($matrix[0]['expansion'] * 100) / $matrix[0]['mrr'], 1);
        $perresurrected = round(($matrix[0]['resurrected'] * 100) / $matrix[0]['mrr'], 1);
        $perrecurrent = 100 - ($pernew + $perexpansion + $perresurrected);
        $percontraction = round(($matrix[0]['contraction'] * 100) / ($matrix[0]['contraction'] + $matrix{0}['cancelled']), 1);
        $percancelled = round(($matrix[0]['cancelled'] * 100) / ($matrix[0]['contraction'] + $matrix{0}['cancelled']), 1);
        $saas = [$perrecurrent, $pernew, $perresurrected, $perexpansion, $percontraction, $percancelled];
        $recdetails = [0, $matrix[0]['cancelled'], $matrix[0]['contraction'], $matrix[0]['expansion'], $matrix[0]['resurrected'], $matrix[0]['new']];


        // DEVOLVENDO AS ESTATÍSTICAS PARA OS GRÁFICOS DO INDEX
        $datachart = [];

        for ($x = 5; $x >= 0; $x--) {

            array_push($datachart, [
                "month" => $matrix[$x]['month'],
                "saas" => $saas[$x],
                "mrr" => $matrix[$x]['mrr'],
                "recorrentes" => $matrix[$x]['mrr'] - ($matrix[$x]['new'] + $matrix[$x]['resurrected'] + $matrix[$x]['expansion']),
                "arpu" => ($matrix[$x]['mrrc'] > 0) ? round($matrix[$x]['mrr'] / $matrix[$x]['mrrc'], 2) : 0,
                "entradas" => $matrix[$x]['new'] + $matrix[$x]['resurrected'] + $matrix[$x]['expansion'],
                "saidas" => $matrix[$x]['contraction'] + $matrix[$x]['cancelled'],
                "recdetails" => $recdetails[$x]
            ]);

        }

        return $datachart;

    }

    public static function statisticsDataChart($year, $month)
    {

        // MONTANDO A DATA DA PESQUISA
        $dataYearMonth = "$year-$month-01";


        // CHAMANDO A MATRIZ DE PAGAMENTOS
        $matrix = Statistic::matrixPayments($year, $month);


        // CHAMANDO OS PLANOS VENDIDOS NO PERÍODO
        $saleplan = Statistic::salePlan($year, $month);


        // NICHO DE MERCADO (CONTINUA...)
        // --> PREPARANDO E MONTANDO AS ESTATÍSTICAS <--
        $saasnew = round(($matrix[0]['new'] * 100) / $matrix[0]['mrr'], 1);
        $saasexpansion = round(($matrix[0]['expansion'] * 100) / $matrix[0]['mrr'], 1);
        $saasresurrected = round(($matrix[0]['resurrected'] * 100) / $matrix[0]['mrr'], 1);
        $saasrecurrent = 100 - ($saasnew + $saasexpansion + $saasresurrected);
        $saascontraction = round(($matrix[0]['contraction'] * 100) / ($matrix[0]['contraction'] + $matrix{0}['cancelled']), 1);
        $saascancelled = round(($matrix[0]['cancelled'] * 100) / ($matrix[0]['contraction'] + $matrix{0}['cancelled']), 1);
        $saaschurnN = round(($matrix[0]['mrrc'] - $matrix[1]['mrrc']) * 100 / $matrix[1]['mrrc'], 2);
        $saaschurnA = round(($matrix[1]['mrrc'] - $matrix[2]['mrrc']) * 100 / $matrix[2]['mrrc'], 2);


        // TOPO
        // --> PREPARANDO E MONTANDO AS ESTATÍSTICAS <--
        $perblock[0] = ($matrix[1]['mrr'] != 0) ? round(($matrix[0]['mrr'] - $matrix[1]['mrr']) * 100 / $matrix[1]['mrr'], 2) : 0;
        $perblock[1] = ($matrix[1]['new'] != 0) ? round(($matrix[0]['new'] - $matrix[1]['new']) * 100 / $matrix[1]['new'], 2) : 0;
        $perblock[2] = ($matrix[1]['resurrected'] != 0) ? round(($matrix[0]['resurrected'] - $matrix[1]['resurrected']) * 100 / $matrix[1]['resurrected'], 2) : 0;
        $perblock[3] = ($matrix[1]['expansion'] != 0) ? round(($matrix[0]['expansion'] - $matrix[1]['expansion']) * 100 / $matrix[1]['expansion'], 2) : 0;
        $perblock[4] = ($matrix[1]['contraction'] != 0) ? round(($matrix[0]['contraction'] - $matrix[1]['contraction']) * 100 / $matrix[1]['contraction'], 2) : 0;
        $perblock[5] = ($matrix[1]['cancelled'] != 0) ? round(($matrix[0]['cancelled'] - $matrix[1]['cancelled']) * 100 / $matrix[1]['cancelled'], 2) : 0;
        $perblock[6] = ($matrix[1]['mrr'] != 0) ? round(($matrix[0]['mrr'] - $matrix[1]['mrr']) * 100 / $matrix[1]['mrr'], 2) : 0;
        $perblock[7] = ($saaschurnA != 0) ? round(($saaschurnN - $saaschurnA) * 100 / $saaschurnA, 2) : 0;
        $vlblock = [
            $matrix[0]['mrr'],
            $matrix[0]['new'],
            $matrix[0]['resurrected'],
            $matrix[0]['expansion'],
            $matrix[0]['contraction'],
            $matrix[0]['cancelled'],
            ($matrix[0]['mrrc'] > 0) ? round($matrix[0]['mrr'] / $matrix[0]['mrrc'], 2) : 0,
            $saaschurnN];
        $nameblock = ['MRR', 'NEW', 'RESURRECTED', 'EXPANSION', 'CONTRACTION', 'CANCELLED', 'TICKET', 'CHURN'];

        for ($x = 0; $x < 8; $x++) {
            if ($x == 4 || $x == 5 || $x == 7) {
                if ($perblock[$x] < 0) $vsblock[$x] = "green";
                if ($perblock[$x] == 0) $vsblock[$x] = "yellow";
                if ($perblock[$x] > 0) $vsblock[$x] = "red";
            } else {
                if ($perblock[$x] < 0) $vsblock[$x] = "red";
                if ($perblock[$x] == 0) $vsblock[$x] = "yellow";
                if ($perblock[$x] > 0) $vsblock[$x] = "green";
            }
            if ($perblock[$x] < 0) $caretblock[$x] = "down";
            if ($perblock[$x] == 0) $caretblock[$x] = "left";
            if ($perblock[$x] > 0) $caretblock[$x] = "up";
        }


        // TOPO
        // --> FINALIZANDO E ARMAZENANDO OS DADOS À SEREM ENVIADOS <--
        $datachart = [];

        for ($x = 0; $x < 8; $x++) {
            array_push($datachart, [
                "vsblock" => $vsblock[$x],
                "caretblock" => $caretblock[$x],
                "perblock" => $perblock[$x],
                "vlblock" => $vlblock[$x],
                "nameblock" => $nameblock[$x]
            ]);

        }


        // NICHO DE MERCADO (...CONTINUAÇÃO)
        // --> PREPARANDO E MONTANDO AS ESTATÍSTICAS <--














        // NICHO DE MERCADO
        // --> ARMAZENANDO OS DADOS À SEREM ENVIADOS <--
        array_push($datachart, [
            "saas" => [$saasrecurrent, $saasnew, $saasresurrected, $saasexpansion, $saascontraction, $saascancelled]
        ]);


        // PLANOS E CHURN
        // --> PREPARANDO E MONTANDO AS ESTATÍSTICAS <--
        for ($s = 0; $s < count($saleplan); $s++) {

            // ID DO PLANO
            $id = $saleplan[$s]['idplan'];

            // QTD DE PLANOS VENDIDOS
            $qtdplan = $saleplan[$s]['qtdplan'];

            for ($q = 0; $q < 6; $q++) {
                if (!isset($sumPlanMonth[$q])) $sumPlanMonth[$q] = 0;

                $churnChart[$q] = round($matrix[$q]['cancelledc'] * 100 / ($matrix[$q]['mrrc'] + $matrix[$q]['cancelledc']), 2);

                if ($saleplan[$s]['YearMonth'] == date('Y-m', strtotime("-$q month", strtotime($dataYearMonth)))) {
                    switch ($id) {
                        case 1:
                            $bronzePlanoChart[$q] = $qtdplan;
                            $sumPlanMonth[$q] += $qtdplan;
                            break;
                        case 2:
                            $prataPlanoChart[$q] = $qtdplan;
                            $sumPlanMonth[$q] += $qtdplan;
                            break;
                        case 3:
                            $ouroPlanoChart[$q] = $qtdplan;
                            $sumPlanMonth[$q] += $qtdplan;
                            break;
                        case 4:
                            $platinaPlanoChart[$q] = $qtdplan;
                            $sumPlanMonth[$q] += $qtdplan;
                            break;
                    }
                }
            }
        }


        // PLANOS E CHURN
        // --> ARMAZENANDO OS DADOS À SEREM ENVIADOS <--
        for ($x = 5; $x >= 0; $x--) {
            array_push($datachart, [
                "month" => $matrix[$x]['month'],
                "bronzePlanoChart" => round(($bronzePlanoChart[$x] * 100) / $sumPlanMonth[$x], 0),
                "prataPlanoChart" => round(($prataPlanoChart[$x] * 100) / $sumPlanMonth[$x], 0),
                "ouroPlanoChart" => round(($ouroPlanoChart[$x] * 100) / $sumPlanMonth[$x], 0),
                "platinaPlanoChart" => round(($platinaPlanoChart[$x] * 100) / $sumPlanMonth[$x], 0),
                "churnChart" => $churnChart[$x]
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