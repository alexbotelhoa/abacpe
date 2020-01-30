<?php

namespace ABA;

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

    private function setData($data = array())
    {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function __construct($opts = array(), $tlp_dir = "/app/views/site/")
    {
        $this->options = array_merge($this->default, $opts);

        $config = array(
            "tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . $tlp_dir,
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"] . "/app/views/cache/",
            "debug" => false
        );

        Tpl::configure($config);

        $this->tpl = new Tpl();

        $this->setData($this->options["data"]);

        if ($this->options["header"] === true) $this->tpl->draw("header");

    }

    public function setTpl($name, $data = array(), $returnHTML = false)
    {
        $this->setData($data);

        return $this->tpl->draw($name, $returnHTML);
    }

    public function __destruct()
    {
        if ($this->options["footer"] === true) $this->tpl->draw("footer");
    }
}