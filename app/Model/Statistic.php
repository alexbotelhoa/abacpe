<?php

namespace SCE\Model;

use SCE\Model;
use SCE\Control\Sql;
use SCE\Control\Client;

class Statistic extends Model
{
    public static function pathFileStatistics($test = false)
    {
        ($test) ? $path = ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR : $path = "";

        $path .=
            "res" . DIRECTORY_SEPARATOR .
            "site" . DIRECTORY_SEPARATOR .
            "statistics";

        return $path;
    }

    public static function registerStatistics($year, $month, $page, $content, $test = false)
    {
        $path = Statistic::pathFileStatistics($test);
        $file = json_encode($content);

        $fp = fopen($path . DIRECTORY_SEPARATOR . "$page-$year-$month.json", "w+");
        fwrite($fp, $file);

        return fclose($fp);
    }

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

    public static function nichoStatistics($metric)
    {
        if (count($metric) != 0) {
            $nicho = array_count_values($metric);
            arsort($nicho);

            $x = 0;
            $tv = 0;
            foreach ($nicho as $k => &$v) {
                if ($x < 5) {
                    $nichorec[$x][0] = $k;
                    $nichorec[$x][1] = round(($v * 100) / count($metric), 2);
                    $tv += $v;
                }
                $x++;
            }

            array_push($nichorec, [
                0 => "Outros",
                1 => round(((count($metric) - $tv) * 100) / count($metric), 2)
            ]);
        } else {
            for ($y = 0; $y < 6; $y++) {
                $nichorec[$y][0] = "";
                $nichorec[$y][1] = 0;
            }
        }

        return $nichorec;
    }

    public static function matrixPayments($year, $month, $test = false)
    {
        // MONTANDO A DATA DA PESQUISA
        $dataYearMonth = "$year-$month-01";

        // BUSCANDO AS INFORMAÇÕES DOS CLIENTES
        $clients = $_SESSION['BASECLIENTES'];

        // BUSCANDO OS PRIMEIROS PAGAMENTOS DOS CLIENTES
        $firstpay = Statistic::firstPayment();

        // CRIANDO UMA MATRIZ COM AS INFORMAÇÕES DOS CLIENTES E COM OS PAGAMENTOS ZERADOS
        for ($c = 0; $c < count($clients); $c++) {
            for ($d = 0; $d < 7; $d++) {
                $matrix[$clients[$c]['id']][$d]['dtpayment'] = 0;
                $matrix[$clients[$c]['id']][$d]['vlpayment'] = 0;
            }
            $matrix[$clients[$c]['id']][7]['idclient'] = $clients[$c]['id'];
            $matrix[$clients[$c]['id']][7]['desclient'] = $clients[$c]['nome'];
            $matrix[$clients[$c]['id']][7]['descity'] = $clients[$c]['cidade'];
            $matrix[$clients[$c]['id']][7]['desstate'] = $clients[$c]['estado'];
            $matrix[$clients[$c]['id']][7]['dessegment'] = $clients[$c]['segmento'];
            $matrix[$clients[$c]['id']][7]['firstpayment'] = $firstpay[$c]['dtpayment'];
        }

        // BUSCANDO OS PAGAMENTOS DOS CLIENTES
        $sql = new Sql();
        $payment = $sql->select("
            SELECT * FROM tb_payments WHERE dtpayment 
            BETWEEN ADDDATE('" . $year . "-" . $month . "-01', INTERVAL -11 MONTH) AND '" . $year . "-" . $month . "-31' 
            ORDER BY dtpayment DESC");

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
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-1 month", strtotime($dataYearMonth)))) { // 1 mes atrás
                $matrix[$id][1]['dtpayment'] = $dtpayment;
                $matrix[$id][1]['vlpayment'] = $vlpayment;

                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][0]['dtpayment'] = $dtpayment;
                    $matrix[$id][0]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-2 month", strtotime($dataYearMonth)))) { // 2 meses atrás
                $matrix[$id][2]['dtpayment'] = $dtpayment;
                $matrix[$id][2]['vlpayment'] = $vlpayment;

                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][0]['dtpayment'] = $dtpayment;
                    $matrix[$id][0]['vlpayment'] = $vlpayment;
                    $matrix[$id][1]['dtpayment'] = $dtpayment;
                    $matrix[$id][1]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-3 month", strtotime($dataYearMonth)))) { // 3 meses atrás
                $matrix[$id][3]['dtpayment'] = $dtpayment;
                $matrix[$id][3]['vlpayment'] = $vlpayment;

                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][1]['dtpayment'] = $dtpayment;
                    $matrix[$id][1]['vlpayment'] = $vlpayment;
                    $matrix[$id][2]['dtpayment'] = $dtpayment;
                    $matrix[$id][2]['vlpayment'] = $vlpayment;
                }

                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][0]['dtpayment'] = $dtpayment;
                    $matrix[$id][0]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-4 month", strtotime($dataYearMonth)))) { // 4 meses atrás
                $matrix[$id][4]['dtpayment'] = $dtpayment;
                $matrix[$id][4]['vlpayment'] = $vlpayment;

                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][2]['dtpayment'] = $dtpayment;
                    $matrix[$id][2]['vlpayment'] = $vlpayment;
                    $matrix[$id][3]['dtpayment'] = $dtpayment;
                    $matrix[$id][3]['vlpayment'] = $vlpayment;
                }

                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][0]['dtpayment'] = $dtpayment;
                    $matrix[$id][0]['vlpayment'] = $vlpayment;
                    $matrix[$id][1]['dtpayment'] = $dtpayment;
                    $matrix[$id][1]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-5 month", strtotime($dataYearMonth)))) { // 5 meses atrás
                $matrix[$id][5]['dtpayment'] = $dtpayment;
                $matrix[$id][5]['vlpayment'] = $vlpayment;

                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][3]['dtpayment'] = $dtpayment;
                    $matrix[$id][3]['vlpayment'] = $vlpayment;
                    $matrix[$id][4]['dtpayment'] = $dtpayment;
                    $matrix[$id][4]['vlpayment'] = $vlpayment;
                }

                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][0]['dtpayment'] = $dtpayment;
                    $matrix[$id][0]['vlpayment'] = $vlpayment;
                    $matrix[$id][1]['dtpayment'] = $dtpayment;
                    $matrix[$id][1]['vlpayment'] = $vlpayment;
                    $matrix[$id][2]['dtpayment'] = $dtpayment;
                    $matrix[$id][2]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-6 month", strtotime($dataYearMonth)))) { // 6 meses atrás
                $matrix[$id][6]['dtpayment'] = $dtpayment;
                $matrix[$id][6]['vlpayment'] = $vlpayment;

                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][4]['dtpayment'] = $dtpayment;
                    $matrix[$id][4]['vlpayment'] = $vlpayment;
                    $matrix[$id][5]['dtpayment'] = $dtpayment;
                    $matrix[$id][5]['vlpayment'] = $vlpayment;
                }

                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][1]['dtpayment'] = $dtpayment;
                    $matrix[$id][1]['vlpayment'] = $vlpayment;
                    $matrix[$id][2]['dtpayment'] = $dtpayment;
                    $matrix[$id][2]['vlpayment'] = $vlpayment;
                    $matrix[$id][3]['dtpayment'] = $dtpayment;
                    $matrix[$id][3]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-7 month", strtotime($dataYearMonth)))) { // 7 meses atrás
                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][5]['dtpayment'] = $dtpayment;
                    $matrix[$id][5]['vlpayment'] = $vlpayment;
                    $matrix[$id][6]['dtpayment'] = $dtpayment;
                    $matrix[$id][6]['vlpayment'] = $vlpayment;
                }

                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][2]['dtpayment'] = $dtpayment;
                    $matrix[$id][2]['vlpayment'] = $vlpayment;
                    $matrix[$id][3]['dtpayment'] = $dtpayment;
                    $matrix[$id][3]['vlpayment'] = $vlpayment;
                    $matrix[$id][4]['dtpayment'] = $dtpayment;
                    $matrix[$id][4]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-8 month", strtotime($dataYearMonth)))) { // 8 meses atrás
                if (in_array($payment[$p]['vlrecurrence'], array(3, 6))) {
                    $matrix[$id][6]['dtpayment'] = $dtpayment;
                    $matrix[$id][6]['vlpayment'] = $vlpayment;
                }

                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][3]['dtpayment'] = $dtpayment;
                    $matrix[$id][3]['vlpayment'] = $vlpayment;
                    $matrix[$id][4]['dtpayment'] = $dtpayment;
                    $matrix[$id][4]['vlpayment'] = $vlpayment;
                    $matrix[$id][5]['dtpayment'] = $dtpayment;
                    $matrix[$id][5]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-9 month", strtotime($dataYearMonth)))) { // 9 meses atrás
                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][4]['dtpayment'] = $dtpayment;
                    $matrix[$id][4]['vlpayment'] = $vlpayment;
                    $matrix[$id][5]['dtpayment'] = $dtpayment;
                    $matrix[$id][5]['vlpayment'] = $vlpayment;
                    $matrix[$id][6]['dtpayment'] = $dtpayment;
                    $matrix[$id][6]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-10 month", strtotime($dataYearMonth)))) { // 10 meses atrás
                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][5]['dtpayment'] = $dtpayment;
                    $matrix[$id][5]['vlpayment'] = $vlpayment;
                    $matrix[$id][6]['dtpayment'] = $dtpayment;
                    $matrix[$id][6]['vlpayment'] = $vlpayment;
                }
            } elseif (date('Y-m', strtotime($payment[$p]['dtpayment'])) == date('Y-m', strtotime("-11 month", strtotime($dataYearMonth)))) { // 11 meses atrás
                if (in_array($payment[$p]['vlrecurrence'], array(6))) {
                    $matrix[$id][6]['dtpayment'] = $dtpayment;
                    $matrix[$id][6]['vlpayment'] = $vlpayment;
                }
            }
        }

        $statistics = Statistic::registerStatistics($year, $month, "matrix", $matrix, $test);

        (boolval($clients) && boolval($firstpay) && boolval($payment) && boolval($statistics) && count($matrix) != 0) ? $return = true : $return = false;

        return $return;
    }

    public static function metricasSaas($year, $month, $test = false)
    {
        // MONTANDO A DATA DA PESQUISA
        $dataYearMonth = "$year-$month-01";

        // CAMINHO PARA O ARQUIVOS COM AS ESTATÍSTICAS
        $path = Statistic::pathFileStatistics($test);

        // VERIFICA SE O ARQUIVO MATRIX DO INTERVALO JÁ EXISTE E SE OS TEMPOS DE ATUALIZAÇÃO JÁ FORAM ULTRAPASSADOS
        $file = $path . DIRECTORY_SEPARATOR . "matrix-$year-$month.json";

        if (!file_exists($file) || filemtime($file) < (mktime() - $_SESSION['tw_file_client'])) Statistic::matrixPayments($year, $month, $test);

        // CHAMA O ARQUIVO COM A MATRIX DO INTERVALO CRIADA
        $json_file = file_get_contents($file);
        $matrix = json_decode($json_file, true);

        // ARMAZENANDO OS CLIENTES E SEUS PRIMEIROS PAGAMENTOS
        $firstPayment = Statistic::firstPayment();

        // CRIANDO A MATRIZ VAZIA DAS ESTATÍSTICAS SAAS
        for ($d = 0; $d < 6; $d++) {
            $mrr[$d] = 0;
            $mrrc[$d] = 0;
            $recurrent[$d] = 0;
            $new[$d] = 0;
            $resurrected[$d] = 0;
            $expansion[$d] = 0;
            $contraction[$d] = 0;
            $cancelled[$d] = 0;
            $cancelledc[$d] = 0;
            $nichostt[$d] = [];
            $nichoseg[$d] = [];
        }

        // CALCULANDO AS MÉTRICAS SAAS
        for ($c = 0; $c < count($matrix); $c++) {

            // ID DO CLIENTE
            $id = $firstPayment[$c]['idclient'];

            // PRIMEIRO PAGAMENTO
            $firstpayment = $firstPayment[$c]['dtpayment'];

            for ($d = 0; $d < 6; $d++) {

                // DATA DO PAGAMENTO ATUAL
                $dtpayment = $matrix[$id][$d]['dtpayment'];

                // VALOR DO PAGAMENTO ATUAL
                $vlpayment = $matrix[$id][$d]['vlpayment'];

                // VALOR DO PAGAMENTO ANTERIOR
                $agopayment = $matrix[$id][$d + 1]['vlpayment'];

                // VALOR DO SEGMENTO;
                $desstate = $matrix[$id][7]['desstate'];

                // VALOR DO SEGMENTO;
                $dessegment = $matrix[$id][7]['dessegment'];

                // RECEITAS GERAL
                if ($vlpayment != 0) {
                    $mrr[$d] += $vlpayment;
                    $mrrc[$d]++;
                }

                // RECEITA RECORRENTE DE ENTRADA
                if ($vlpayment != 0 && $agopayment != 0 && $vlpayment == $agopayment) {
                    $recurrent[$d] += $vlpayment;
                    if ($d == 0) {
                        $nichostt[0][$id] = $desstate;
                        $nichoseg[0][$id] = $dessegment;
                    }
                }

                // RECEITAS VARIÁVEIS DE ENTRADA
                if ($vlpayment != 0 && $dtpayment == $firstpayment) {
                    $new[$d] += $vlpayment;
                    if ($d == 0) {
                        $nichostt[1][$id] = $desstate;
                        $nichoseg[1][$id] = $dessegment;
                    }
                }

                if ($vlpayment != 0 && $agopayment == 0 && $dtpayment > $firstpayment) {
                    $resurrected[$d] += $vlpayment;
                    if ($d == 0) {
                        $nichostt[2][$id] = $desstate;
                        $nichoseg[2][$id] = $dessegment;
                    }
                }

                if ($vlpayment != 0 && $agopayment != 0 && $vlpayment > $agopayment) {
                    $expansion[$d] += ($vlpayment - $agopayment);
                    if ($d == 0) {
                        $nichostt[3][$id] = $desstate;
                        $nichoseg[3][$id] = $dessegment;
                    }
                }

                // RECEITAS VARIÁVEIS DE SAÍDA
                if ($vlpayment != 0 && $agopayment != 0 && $vlpayment < $agopayment) {
                    $contraction[$d] += ($agopayment - $vlpayment);
                    if ($d == 0) {
                        $nichostt[4][$id] = $desstate;
                        $nichoseg[4][$id] = $dessegment;
                    }
                }

                if ($vlpayment == 0 && $agopayment != 0) {
                    $cancelled[$d] += $agopayment;
                    $cancelledc[$d]++;
                    if ($d == 0) {
                        $nichostt[5][$id] = $desstate;
                        $nichoseg[5][$id] = $dessegment;
                    }
                }
            }
        }

        // DEVOLVENDO AS MÉTRICAS SAAS PARAMETRIZADAS
        $datachart = [];
        for ($x = 0; $x < 6; $x++) {
            array_push($datachart, [
                "month" => date('M/y', strtotime("-$x month", strtotime($dataYearMonth))),
                "mrr" => $mrr[$x],
                "mrrc" => $mrrc[$x],
                "recurrent" => $recurrent[$x],
                "new" => $new[$x],
                "resurrected" => $resurrected[$x],
                "expansion" => $expansion{$x},
                "contraction" => $contraction{$x},
                "cancelled" => $cancelled[$x],
                "cancelledc" => $cancelledc[$x],
                "nichostt" => $nichostt[$x],
                "nichoseg" => $nichoseg[$x]
            ]);
        }

        return $datachart;
    }

    public static function indexDataChart($year, $month, $test = false)
    {
        // BUSCANDO AS MÉTRICAS SAAS JÁ PARAMETRIZADAS
        $metricas = Statistic::metricasSaas($year, $month, $test);

        // MONTANDO OS VALORES E PERCENTUAIS DAS MÉTRICAS SAAS
        $pernew = 0;
        $perexpansion = 0;
        $perresurrected = 0;
        $percontraction = 0;
        $percancelled = 0;

        if ($metricas[0]['mrr'] > 0) {
            $pernew = round(($metricas[0]['new'] * 100) / $metricas[0]['mrr'], 1);
            $perexpansion = round(($metricas[0]['expansion'] * 100) / $metricas[0]['mrr'], 1);
            $perresurrected = round(($metricas[0]['resurrected'] * 100) / $metricas[0]['mrr'], 1);
        }

        if ($metricas[0]['cancelled'] > 0) {
            $percontraction = round(($metricas[0]['contraction'] * 100) / ($metricas[0]['contraction'] + $metricas{0}['cancelled']), 1);
            $percancelled = round(($metricas[0]['cancelled'] * 100) / ($metricas[0]['contraction'] + $metricas{0}['cancelled']), 1);
        }

        $perrecurrent = 100 - ($pernew + $perexpansion + $perresurrected);
        $saas = [$perrecurrent, $pernew, $perresurrected, $perexpansion, $percontraction, $percancelled];
        $recdetails = [0, $metricas[0]['cancelled'], $metricas[0]['contraction'], $metricas[0]['expansion'], $metricas[0]['resurrected'], $metricas[0]['new']];

        // DEVOLVENDO AS ESTATÍSTICAS PARA OS GRÁFICOS DO INDEX
        $datachart = [];
        for ($x = 5; $x >= 0; $x--) {
            array_push($datachart, [
                "month" => $metricas[$x]['month'],
                "saas" => $saas[$x],
                "mrr" => $metricas[$x]['mrr'],
                "recorrentes" => $metricas[$x]['mrr'] - ($metricas[$x]['new'] + $metricas[$x]['resurrected'] + $metricas[$x]['expansion']),
                "arpu" => ($metricas[$x]['mrrc'] > 0) ? round($metricas[$x]['mrr'] / $metricas[$x]['mrrc'], 2) : 0,
                "entradas" => $metricas[$x]['new'] + $metricas[$x]['resurrected'] + $metricas[$x]['expansion'],
                "saidas" => $metricas[$x]['contraction'] + $metricas[$x]['cancelled'],
                "recdetails" => $recdetails[$x]
            ]);
        }

        $statistics = Statistic::registerStatistics($year, $month, "index", $datachart, $test);

        (boolval($metricas) && boolval($statistics) && count($datachart) != []) ? $return = true : $return = false;

        return $return;
    }

    public static function statisticsDataChart($year, $month, $test = false)
    {
        /*  [8] = Recurrent  |  [9] = New  |  [10] = Resurrected  |  [11] = Expansion  |  [12] = Contraction  |  [13] = Cancelled  */
        // MONTANDO A DATA DA PESQUISA
        $dataYearMonth = "$year-$month-01";

        // CHAMANDO AS MÉTRICAS SAAS DA PESQUISA
        $metricas = Statistic::metricasSaas($year, $month, $test);

        // CHAMANDO OS PLANOS VENDIDOS NO PERÍODO
        $saleplan = Statistic::salePlan($year, $month);

        // NICHO DE MERCADO
        for ($x = 0; $x < 6; $x++) {
            $saas[$x] = 0;
        }

        if ($metricas[0]['mrr'] > 0) {
            $saas[0] = round(($metricas[0]['recurrent'] * 100) / $metricas[0]['mrr'], 1);
            $saas[1] = round(($metricas[0]['new'] * 100) / $metricas[0]['mrr'], 1);
            $saas[2] = round(($metricas[0]['resurrected'] * 100) / $metricas[0]['mrr'], 1);
            $saas[3] = round(($metricas[0]['expansion'] * 100) / $metricas[0]['mrr'], 1);
        }

        if (($metricas[0]['contraction'] + $metricas{0}['cancelled']) > 0) {
            $saas[4] = round(($metricas[0]['contraction'] * 100) / ($metricas[0]['contraction'] + $metricas{0}['cancelled']), 1);
            $saas[5] = round(($metricas[0]['cancelled'] * 100) / ($metricas[0]['contraction'] + $metricas{0}['cancelled']), 1);
        }

        ($metricas[1]['mrr'] > 0) ? $saaschurnN = round(($metricas[0]['mrrc'] - $metricas[1]['mrrc']) * 100 / $metricas[1]['mrrc'], 2) : $saaschurnN = 0;
        ($metricas[2]['mrrc'] > 0) ? $saaschurnA = round(($metricas[1]['mrrc'] - $metricas[2]['mrrc']) * 100 / $metricas[2]['mrrc'], 2) : $saaschurnA = 0;

        // NICHO DE MERCADO e TOP 5 DOS ESTADOS
        for ($x = 0; $x < 6; $x++) {
            $nichoseg[$x] = Statistic::nichoStatistics($metricas[$x]['nichoseg']);
            $nichostt[$x] = Statistic::nichoStatistics($metricas[$x]['nichostt']);
        }

        // TOPO
        $perblock[0] = ($metricas[1]['mrr'] > 0) ? round(($metricas[0]['mrr'] - $metricas[1]['mrr']) * 100 / $metricas[1]['mrr'], 2) : 0;
        $perblock[1] = ($metricas[1]['new'] > 0) ? round(($metricas[0]['new'] - $metricas[1]['new']) * 100 / $metricas[1]['new'], 2) : 0;
        $perblock[2] = ($metricas[1]['resurrected'] > 0) ? round(($metricas[0]['resurrected'] - $metricas[1]['resurrected']) * 100 / $metricas[1]['resurrected'], 2) : 0;
        $perblock[3] = ($metricas[1]['expansion'] > 0) ? round(($metricas[0]['expansion'] - $metricas[1]['expansion']) * 100 / $metricas[1]['expansion'], 2) : 0;
        $perblock[4] = ($metricas[1]['contraction'] > 0) ? round(($metricas[0]['contraction'] - $metricas[1]['contraction']) * 100 / $metricas[1]['contraction'], 2) : 0;
        $perblock[5] = ($metricas[1]['cancelled'] > 0) ? round(($metricas[0]['cancelled'] - $metricas[1]['cancelled']) * 100 / $metricas[1]['cancelled'], 2) : 0;
        $perblock[6] = ($metricas[1]['mrr'] > 0) ? round(($metricas[0]['mrr'] - $metricas[1]['mrr']) * 100 / $metricas[1]['mrr'], 2) : 0;
        $perblock[7] = ($saaschurnA > 0) ? round(($saaschurnN - $saaschurnA) * 100 / $saaschurnA, 2) : 0;
        $vlblock = [
            $metricas[0]['mrr'],
            $metricas[0]['new'],
            $metricas[0]['resurrected'],
            $metricas[0]['expansion'],
            $metricas[0]['contraction'],
            $metricas[0]['cancelled'],
            ($metricas[0]['mrrc'] > 0) ? round($metricas[0]['mrr'] / $metricas[0]['mrrc'], 2) : 0,
            $saaschurnN
        ];
        $nameblock = ['MRR', 'New', 'Resurrected', 'Expansion', 'Contraction', 'Cancelled', 'Ticket', 'Churn'];

        for ($x = 0; $x < 8; $x++) {
            if ($x == 4 || $x == 5 || $x == 7) {
                if ($perblock[$x] < 0) {
                    $vsblock[$x] = "green";
                }
                if ($perblock[$x] == 0) {
                    $vsblock[$x] = "yellow";
                }
                if ($perblock[$x] > 0) {
                    $vsblock[$x] = "red";
                }
            } else {
                if ($perblock[$x] < 0) {
                    $vsblock[$x] = "red";
                }
                if ($perblock[$x] == 0) {
                    $vsblock[$x] = "yellow";
                }
                if ($perblock[$x] > 0) {
                    $vsblock[$x] = "green";
                }
            }
            if ($perblock[$x] < 0) {
                $caretblock[$x] = "down";
            }
            if ($perblock[$x] == 0) {
                $caretblock[$x] = "left";
            }
            if ($perblock[$x] > 0) {
                $caretblock[$x] = "up";
            }
        }

        // PLANOS VENDIDOS
        if (count($saleplan) > 0) {
            for ($s = 0; $s < count($saleplan); $s++) {

                // ID DO PLANO
                $id = $saleplan[$s]['idplan'];

                // QTD DE PLANOS VENDIDOS
                $qtdplan = $saleplan[$s]['qtdplan'];

                for ($q = 0; $q < 6; $q++) {
                    if (!isset($sumPlanMonth[$q])) {
                        $sumPlanMonth[$q] = 0;
                    }

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
        } else {
            for ($q = 0; $q < 6; $q++) {
                $bronzePlanoChart[$q] = 0;
                $prataPlanoChart[$q] = 0;
                $ouroPlanoChart[$q] = 0;
                $platinaPlanoChart[$q] = 0;
                $sumPlanMonth[$q] = 0;
            }
        }

        // RATE CHURN
        for ($q = 0; $q < 6; $q++) {
            (($metricas[$q]['mrrc'] + $metricas[$q]['cancelledc']) > 0) ? $churnChart[$q] = round($metricas[$q]['cancelledc'] * 100 / ($metricas[$q]['mrrc'] + $metricas[$q]['cancelledc']),
                2) : $churnChart[$q] = 00;
        }

        // TOPO
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

        // NICHO DE MERCADO e TOP 5 DOS ESTADOS
        for ($x = 0; $x < 6; $x++) {
            array_push($datachart, [
                "saas" => $saas[$x],
                "nichoseg" => $nichoseg[$x],
                "nichostt" => $nichostt[$x]
            ]);
        }

        // PLANOS VENDIDOS e RATE CHURN
        for ($x = 5; $x >= 0; $x--) {
            array_push($datachart, [
                "month" => $metricas[$x]['month'],
                "bronzePlanoChart" => ($sumPlanMonth[$x] > 0) ? round(($bronzePlanoChart[$x] * 100) / $sumPlanMonth[$x], 1) : 0,
                "prataPlanoChart" => ($sumPlanMonth[$x] > 0) ? round(($prataPlanoChart[$x] * 100) / $sumPlanMonth[$x], 1) : 0,
                "ouroPlanoChart" => ($sumPlanMonth[$x] > 0) ? round(($ouroPlanoChart[$x] * 100) / $sumPlanMonth[$x], 1) : 0,
                "platinaPlanoChart" => ($sumPlanMonth[$x] > 0) ? round(($platinaPlanoChart[$x] * 100) / $sumPlanMonth[$x], 1) : 0,
                "churnChart" => $churnChart[$x]
            ]);
        }

        $statistics = Statistic::registerStatistics($year, $month, "statistics", $datachart, $test);

        if (
            boolval($metricas) &&
            boolval($saleplan) &&
            boolval($statistics) &&
            count($nameblock) != 0 &&
            count($datachart) != 0
        ) {
            return true;
        }

        return false;
    }
}