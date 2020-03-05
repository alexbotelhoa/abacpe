<?php

namespace SCE\Control;

class Client
{
    public static function urlJsonFileClient()
    {
        $url = "https://demo4417994.mockable.io/clientes/";

        return file_get_contents($url);
    }

    public static function pathAndFileClient($test = false)
    {
        ($test) ? $path = ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "abasce2" . DIRECTORY_SEPARATOR : $path = "";

        $path .=
            "res" . DIRECTORY_SEPARATOR .
            "site" . DIRECTORY_SEPARATOR .
            "json" . DIRECTORY_SEPARATOR .
            "clients.json";

        return $path;
    }

    public static function updateClient($test = false)
    {
        $file = Client::urlJsonFileClient();
        $path = Client::pathAndFileClient($test);

        $fp = fopen($path, "w+");
        fwrite($fp, $file);

        return fclose($fp);
    }

    public static function listClient($test = false)
    {
        $path = Client::pathAndFileClient($test);

        $json_file = file_get_contents($path);

        return json_decode($json_file, true);
    }

}