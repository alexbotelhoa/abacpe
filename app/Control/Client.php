<?php

namespace SCE\Control;

class Client
{
    public static function urlJsonFileClient()
    {
        $url = "https://demo4417994.mockable.io/clientes/";

        return file_get_contents($url);
    }

    public static function pathFileClient()
    {
        $path = "res" . DIRECTORY_SEPARATOR . "site" . DIRECTORY_SEPARATOR . "json" . DIRECTORY_SEPARATOR . "clients.json";

        return $path;
    }

    public static function updateClient()
    {
        $file = Client::urlJsonFileClient();

        $path = Client::pathFileClient();

        $fp = fopen($path, "w+");

        fwrite($fp, $file);

        fclose($fp);
    }

    public static function listClient()
    {
        $json_file = file_get_contents(
            "res" .
            DIRECTORY_SEPARATOR . "site" .
            DIRECTORY_SEPARATOR . "json" .
            DIRECTORY_SEPARATOR . "clients.json");

        return json_decode($json_file, true);
    }

}