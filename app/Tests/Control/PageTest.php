<?php

namespace SCE\Tests\Control;

use PHPUnit\Framework\TestCase;
use SCE\Control\Page;

class PageTest extends TestCase
{
    /**
     * @test
     */
    public function shoulBeTrueWhenInstanciateClass()
    {
        $this->assertInstanceOf(Page::class, new Page(["header" => false, "footer" => false]));
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSetTplNull()
    {
        $page = new Page([
            "header" => false,
            "footer" => false
        ],
            "C:/xampp/htdocs/abasce2/app/Views");

        $value = $page->setTpl('test', ["foo1" => '', "foo2" => ''], true);

        $this->assertNull($value);
    }
}
