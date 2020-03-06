<?php

namespace SCE\Control;

use Rain\Tpl;

class Page
{
    private $tpl;
    private $options = [];
    private $default = [
        "header" => true,
        "footer" => true,
        "data" => []
    ];

    private function setData($data = [])
    {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function __construct($opts = [], $path = "/abasce2/app/Views")
    {
        $this->options = array_merge($this->default, $opts);

        $config = array(
            "tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . $path . "/site/",
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"] . $path . "/cache/",
            "debug" => false
        );

        Tpl::configure($config);
        $this->tpl = new Tpl();
        $this->setData($this->options["data"]);

        if ($this->options["header"] === true) $this->tpl->draw("header");
    }

    public function setTpl($name, $data = [], $returnHTML = false)
    {
        $this->setData($data);
        $this->tpl->draw($name, $returnHTML);
    }

    public function __destruct()
    {
        if ($this->options["footer"] === true) $this->tpl->draw("footer");
    }
}