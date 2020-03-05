<?php

namespace SCE\Tests\Model;

use PHPUnit\Framework\TestCase;
use SCE\Model\Statistic;

class StatisticTest extends TestCase
{
    private $ano;
    private $mes;

    public function setUp()
    {
        $this->ano = 2019;
        $this->mes = 07;
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenInstanciateClass()
    {
        $this->assertInstanceOf(Statistic::class, new Statistic());
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenPathFileStatisticsEqual()
    {
        $path = Statistic::pathFileStatistics();

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
        $value = boolval(Statistic::firstPayment());

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSalePlanTrue()
    {
        $value = boolval(Statistic::salePlan($this->ano, $this->mes));

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenNichoStatisticsEqual()
    {
        $value = [1,2,3,4,5,6];

        $value = Statistic::nichoStatistics($value);

        $this->assertEquals('Outros', $value[5][0]);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenNichoStatisticsCount()
    {
        $value = [];

        $value = Statistic::nichoStatistics($value);

        $this->assertCount(6, $value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenMatrixPaymentsTrue()
    {
        $value = Statistic::matrixPayments($this->ano, $this->mes, true);

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenMatrixPaymentsFalse()
    {
        $value = Statistic::matrixPayments(9999, 99, true);

        $this->assertFalse($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenMetricasSaasTrue()
    {
        $_SESSION['tw_file_client'] = 600;

        $value = Statistic::metricasSaas($this->ano, $this->mes, true);

        $this->assertTrue(boolval($value));
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenIndexDataChartTrue()
    {
        $value = Statistic::indexDataChart($this->ano, $this->mes, true);

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenStatisticsDataChartTrue()
    {
        $value = Statistic::statisticsDataChart($this->ano, $this->mes, true);

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenStatisticsDataChartFalse()
    {
        $value = Statistic::statisticsDataChart(9999, 99, true);

        $this->assertFalse($value);
    }
}
