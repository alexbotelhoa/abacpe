<?php

namespace SCE\Control;

class Client
{

    public static function updateClient()
    {
        $url = "https://demo4417994.mockable.io/clientes/";
        $json_file = file_get_contents($url);

        $fp = fopen($_SESSION['DIRECTORY_JSON'] . "clients.json", "w+");
        fwrite($fp, $json_file);
        fclose($fp);
    }

    public static function listClient()
    {
        $json_file = file_get_contents($_SESSION['DIRECTORY_JSON'] . "clients.json");

        $content = json_decode($json_file, true);

        return $content;
    }

}