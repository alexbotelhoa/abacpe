<?php

namespace SCE\Tests\Control;

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
    public function shoulBeTrueWhenSelectConnectDBTrue()
    {
        $result = $this->sql->select("SELECT * FROM tb_plans");

        $this->assertTrue(boolval($result));
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSelectConnectDBCount()
    {
        $result = $this->sql->select("SELECT * FROM tb_plans");

        $this->assertCount(3, $result[0]);
    }
}