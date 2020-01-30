<?php

namespace ABA;

class PageAdmin extends Page
{
    public function __construct(array $opts = array(), $tlp_dir = "/app/views/admin/")
    {
        parent::__construct($opts, $tlp_dir);
    }
}

