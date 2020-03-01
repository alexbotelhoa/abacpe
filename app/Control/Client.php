<?php

namespace SCE\Control;

class Client
{
    public $value;

    public function __construct($path = '')
    {
        if ($path != '') {
            $this->value = $path;
        } else {
            $this->value = "res" . DIRECTORY_SEPARATOR . "site" . DIRECTORY_SEPARATOR . "json" . DIRECTORY_SEPARATOR . "clients.json";
        }
    }

    public static function urlJsonFileClient()
    {
        $url = "https://demo4417994.mockable.io/clientes/";

        return file_get_contents($url);
    }

    public static function pathFileClient()
    {
        $path =
            "res" . DIRECTORY_SEPARATOR .
            "site" . DIRECTORY_SEPARATOR .
            "json" . DIRECTORY_SEPARATOR .
            "clients.json";

        return $path;
    }

    public function updateClient()
    {
        $file = Client::urlJsonFileClient();

        $fp = fopen($this->value, "w+");

        fwrite($fp, $file);

        return fclose($fp);
    }

    public function listClient()
    {
        $json_file = file_get_contents($this->value);

        return json_decode($json_file, true);
    }

}