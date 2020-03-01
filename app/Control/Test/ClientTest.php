<?php

namespace SCE\Control\Test;

use PHPUnit\Framework\TestCase;
use SCE\Control\Client;

//require_once("../../config.php");

class ClientTest extends TestCase
{
    private $client;
    private $clients;

    public function setup()
    {
        $this->client = new Client();
        $this->clients = new Client('..\..\..\res\site\json\clients.json');
    }

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
        $path = $this->client->pathFileClient();

        $this->assertEquals('res\site\json\clients.json', $path);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenFileClientExist()
    {
        $update = $this->clients->updateClient();

        $this->assertTrue($update);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenListClientNotEmpty()
    {
        $clients = $this->clients->listClient();

        $this->assertNotEmpty($clients);
    }

    /**
     * @test
     */
    public function shoulBeTrueFileExist()
    {
        $exist = file_exists('../../../res/site/json/clients.json');

        $this->assertTrue($exist);
    }

}