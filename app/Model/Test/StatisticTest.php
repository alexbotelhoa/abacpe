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
        $path = Statistic::pathFileStatistics(true);

        $this->assertEquals('res\site\statistics', $path);
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

    /**
     * @test
     */
    public function shoulBeTrueWhenFirstPaymentTrue()
    {
        $value = boolval($this->statistic->firstPayment());

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSalePlanTrue()
    {
        $value = boolval($this->statistic->salePlan(2017, 12));

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenNichoStatisticsEqual()
    {
        $value = [1,2,3,4,5,6];

        $value = $this->statistic->nichoStatistics($value);

        $this->assertEquals('Outros', $value[5][0]);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenNichoStatisticsCount()
    {
        $value = [];

        $value = $this->statistic->nichoStatistics($value);

        $this->assertCount(6, $value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenMatrixPaymentsTrue()
    {
        $value = $this->statistic->matrixPayments(2017, 12, true);

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenMatrixPaymentsFalse()
    {
        $value = $this->statistic->matrixPayments(9999, 99, true);

        $this->assertFalse($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenMetricasSaasTrue()
    {
        $_SESSION['tw_file_client'] = 600;

        $value = $this->statistic->metricasSaas(2017, 12, true);

        $this->assertTrue(boolval($value));
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenIndexDataChartTrue()
    {
        $value = $this->statistic->indexDataChart(2017, 12, true);

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenStatisticsDataChartTrue()
    {
        $value = $this->statistic->statisticsDataChart(2017, 12, true);

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenStatisticsDataChartFalse()
    {
        $value = $this->statistic->statisticsDataChart(9999, 99, true);

        $this->assertFalse($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetStatisticsEqual()
    {
        $id = 0;

        $value = $this->statistic->get($id);

        $this->assertEquals($id, $value[0]['idclient']);
    }
}
