<?php

namespace ABA\Model;

use ABA\Model;
use ABA\DB\Sql;

class Plan extends Model
{

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_plans ORDER BY desplan ASC");

    }

    public static function checkPayment($idplan)
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_payments WHERE idplan = :IDPLAN", [
            ":IDPLAN" => $idplan
        ]);

    }



  //************************************************************************************//
 //                                  FIM DOS STATICOS                                  //
//************************************************************************************//


    public function save()
    {

        $sql = new Sql();

        $result = $sql->select("CALL sp_plans_save(:idplan, :desplan, :vlplan)", [
            ":idplan" => $this->getidplan(),
            ":desplan" => $this->getdesplan(),
            ":vlplan" => $this->getvlplan()
        ]);

        if (count($result) > 0) {

            $this->setData($result[0]);

        }

    }

    public function get($idplan)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_plans WHERE idplan = :IDPLAN", [
            ":IDPLAN" => $idplan
        ]);

        if (count($result) > 0) {

            $this->setData($result[0]);

        }

    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("DELETE FROM tb_plans WHERE idplan = :IDPLAN", [
            ":IDPLAN" => $this->getidplan()
        ]);

    }

    public function getValues()
    {

        return parent::getValues();

    }

    public static function checkList($list)
    {

        foreach ($list as &$row) {

            $p = new Plan();

            $p->setData($row);

            $row = $p->getValues();

        }

        return $list;

    }

    public function getPlanPage($sort, $page = 1, $itemsPerPage = 6)
    {

        $start = ($page - 1) * $itemsPerPage;

        $sql = new Sql();

        $result = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM tb_plans 
            ORDER BY " . $sort . " 
            LIMIT $start, $itemsPerPage");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal");

        return [
            'data' => Plan::checkList($result),
            'total' => (int)$resultTotal[0]['nrtotal'],
            'pages' => ceil($resultTotal[0]['nrtotal'] / $itemsPerPage)
        ];

    }

}