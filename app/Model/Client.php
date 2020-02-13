<?php

namespace ABA\Model;

use ABA\Model;

class Client extends Model
{

    public static function updateClient()
    {

        $url = "https://demo4417994.mockable.io/clientes/";

        $json_file = file_get_contents($url);

        $fp = fopen("clients.json", "w+");
        
        fwrite($fp, $json_file);
        
        fclose($fp);

        Client::listClient();
    
    }

    public static function listClient()
    {

        $json_file = file_get_contents("clients.json");

        $content = json_decode($json_file, true);

        $_SESSION['BASECLIENTES'] = $content;

    }

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