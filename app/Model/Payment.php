<?php

namespace SCE\Model;

use SCE\Model;
use SCE\Control\Sql;
use SCE\Control\Client;

class Payment extends Model
{
    public static function checkPayment($idclient)
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_payments WHERE idclient = :IDCLIENT", [
            ":IDCLIENT" => $idclient
        ]);
    }

    public static function listPaymentPage($list, $test = false)
    {
        foreach ($list as &$row) {
            $payment = new Payment();
            $payment->setData($row);

            if ($test) $_SESSION['BASECLIENTES'] = Client::listClient(true);

            $desclient = $_SESSION['BASECLIENTES'][$payment->getidclient()]['nome'];
            $payment->setdesclient($desclient);

            $row = $payment->getValues();
        }

        return $list;
    }


    //************************************************************************************//
    //                                  FIM DOS STATICOS                                  //
    //************************************************************************************//

    public function getValues()
    {
        return parent::getValues();
    }

    public function save()
    {
        $plan = New Plan();
        $plan->get((int)$this->getidplan());

        $vlpayment = $this->getvlrecurrence() * $plan->getvlplan();

        $sql = new Sql();
        $result = $sql->select("CALL sp_payments_save(:idpayment, :idclient, :dtpayment, :idplan, :vlrecurrence, :vlpayment)", [
            ":idpayment" => $this->getidpayment(),
            ":idclient" => $this->getidclient(),
            ":dtpayment" => $this->getdtpayment(),
            ":idplan" => $this->getidplan(),
            ":vlrecurrence" => $this->getvlrecurrence(),
            ":vlpayment" => $vlpayment
        ]);

        if (count($result) > 0) {$this->setData($result[0]); return true;}

        return false;
    }

    public function get($idpayment)
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_payments WHERE idpayment = :IDPAYMENT", [
            ":IDPAYMENT" => $idpayment
        ]);

        if (count($result) > 0) {
            $this->setData($result[0]);
        }

        return $result;
    }

    public function delete()
    {
        $sql = new Sql();
        $sql->query("DELETE FROM tb_payments WHERE idpayment = :IDPAYMENT", [
            ":IDPAYMENT" => $this->getidpayment()
        ]);
    }

    public function getPaymentPage($sort, $page, $itemsPerPage, $test = false)
    {
        $start = ($page - 1) * $itemsPerPage;

        $sql = new Sql();
        $result = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_payments a
            INNER JOIN (
                SELECT idclient, MAX(dtpayment) AS dtpayment, count(*) AS qtdpay 
                FROM tb_payments 
                GROUP BY idclient
            ) maxdtpayment
            ON a.idclient = maxdtpayment.idclient AND a.dtpayment = maxdtpayment.dtpayment
            INNER JOIN tb_plans b ON b.idplan = a.idplan
            ORDER BY " . $sort . " 
            LIMIT $start, $itemsPerPage
        ");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal");

        return [
            'data' => Payment::listPaymentPage($result, $test),
            'total' => (int)$resultTotal[0]['nrtotal'],
            'pages' => ceil($resultTotal[0]['nrtotal'] / $itemsPerPage)
        ];
    }

    public function getPaymentClientPage($sort, $idclient, $page, $itemsPerPage, $test = false)
    {
        $start = ($page - 1) * $itemsPerPage;

        $sql = new Sql();

        $result = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM tb_payments a
            INNER JOIN tb_plans USING(idplan)
            WHERE idclient = $idclient
            ORDER BY " . $sort . " 
            LIMIT $start, $itemsPerPage
        ");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal");

        return [
            'data' => Payment::listPaymentPage($result, $test),
            'total' => (int)$resultTotal[0]['nrtotal'],
            'pages' => ceil($resultTotal[0]['nrtotal'] / $itemsPerPage)
        ];
    }

}