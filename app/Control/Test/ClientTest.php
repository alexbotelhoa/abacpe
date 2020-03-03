<?php

namespace SCE\Control\Test;

use PHPUnit\Framework\TestCase;
use SCE\Control\Client;

class ClientTest extends TestCase
{
    private $client;

    public function setup()
    {
        $this->client = new Client();
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
        $path = Client::pathFileClient(true);

        $this->assertEquals('res\site\json\clients.json', $path);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenFileClientExist()
    {
        $update = Client::updateClient(true);

        $this->assertTrue($update);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenListClientNotEmpty()
    {
        $clients = Client::listClient(true);

        $this->assertNotEmpty($clients);
    }

    /**
     * @test
     */
    public function shoulBeTrueFileExist()
    {
        $exist = file_exists('res/site/json/clients.json');

        $this->assertTrue($exist);
    }

}