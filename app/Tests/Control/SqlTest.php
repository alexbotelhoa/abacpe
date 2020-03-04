<?php

namespace SCE\Tests;

use PHPUnit\Framework\TestCase;
use SCE\Control\Sql;

class SqlTest extends TestCase
{
    private $sql;

    public function setUp()
    {
        $this->sql = new Sql();
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenInstanciateClass()
    {
        $this->assertInstanceOf(Sql::class, new Sql());
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenQueryConnectDB()
    {
        $result = $this->sql->query("SELECT * FROM tb_plans");

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSelectConnectDB()
    {
        $result = $this->sql->select("SELECT * FROM tb_plans");

        $this->assertCount(4, $result);

        $this->assertEquals('Platina', $result[3]['desplan']);
    }

}