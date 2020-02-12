<?php

namespace ABA\Model;

use ABA\Model;

class Client extends Model
{

    public static function listClientDetails($list)
    {

        foreach ($list as &$row) {

            $client = new Client();

            $client->setData($row);

            $desclient = $_SESSION['BASECLIENTES'][$client->getidclient()]['nome'];

            $client->setdesclient($desclient);

            $row = $client->getValues();

        }

        return $list;

    }

}