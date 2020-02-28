<?php

namespace SCE\Control\Test;

use PHPUnit\Framework\TestCase;
use SCE\Control\Client;

//require_once("../../config.php");

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function shoulBeTrueWhenUrlFileJsonNotEmpty()
    {
        $url = Client::urlJsonFileClient();

        $this->assertNotEmpty($url);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenPathFileClientEqual()
    {
        $path = Client::pathFileClient();

        $this->assertEquals("res\site\json\clients.json", $path);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenFileClientExist()
    {


        $file = Client::updateClient();

        $this->assertTrue($file);
    }

}