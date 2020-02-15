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
    
    }

    public static function listClient()
    {

        $json_file = file_get_contents("clients.json");

        $content = json_decode($json_file, true);

        return $content;

    }

}