<?php

namespace SCE\Model;

use SCE\Model;
use SCE\DB\Sql;

class Plan extends Model
{

    public static function selectPlan()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_plans ORDER BY idplan ASC");
    }

    public static function checkPlan($idplan)
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_payments WHERE idplan = :IDPLAN", [
            ":IDPLAN" => $idplan
        ]);
    }

    public static function listPlanPage($list)
    {
        foreach ($list as &$row) {
            $plans = new Plan();
            $plans->setData($row);
            $row = $plans->getValues();
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

    public function getPlanPage($sort, $page, $itemsPerPage)
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
            'data' => Plan::listPlanPage($result),
            'total' => (int)$resultTotal[0]['nrtotal'],
            'pages' => ceil($resultTotal[0]['nrtotal'] / $itemsPerPage)
        ];
    }

}