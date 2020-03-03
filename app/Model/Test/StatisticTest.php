<?php

namespace SCE\Model;

use PHPUnit\Framework\TestCase;

class StatisticTest extends TestCase
{
    private $statistic;

    public function setUp()
    {
        $this->statistic = new Statistic();
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenPathFileStatisticsEqual()
    {
        $path = Statistic::pathFileStatistics(9999, 99, 'test', true);

        $this->assertEquals('res\site\statistics\test-9999-99.json', $path);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenRegisterStatisticsTrue()
    {
        $content = [
            [
                "foo0" => 'foo',
                "foo1" => 'foo',
                "foo2" => 'foo'
            ],
            [
                "foo0" => 'foo',
                "foo1" => 'foo',
                "foo2" => 'foo'
            ]
        ];

        $value = Statistic::registerStatistics(9999, 99, 'test', $content, true);

        $this->assertTrue($value);
    }
}
