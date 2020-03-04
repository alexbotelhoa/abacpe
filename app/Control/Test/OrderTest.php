<?php

namespace SCE\Control\Test;

use PHPUnit\Framework\TestCase;
use SCE\Control\Order;

class OrderTest extends TestCase
{
    /**
     * @test
     * @dataProvider valueProvider
     */
    public function shoukBeTrueWhenGetOrderEqual($local, $sort, $expected)
    {
        $result = Order::getOrder($local, $sort);

        $this->assertEquals($expected, $result);
    }

    public function valueProvider()
    {
        return [
            'shouldBeTrueWhenFooFooEqual' => ['local' => 'foo', 'sort' => 'foo', 'expected' => false],

            'shouldBeTrueWhenPlansFooEqual' => ['local' => 'plans', 'sort' => 'foo', 'expected' => false],
            'shouldBeTrueWhenPlansIdplanDEqual' => ['local' => 'plans', 'sort' => 'ordid', 'expected' => true],
            'shouldBeTrueWhenPlansDesplanEqual' => ['local' => 'plans', 'sort' => 'ordplan', 'expected' => true],
            'shouldBeTrueWhenPlansVlplanEqual' => ['local' => 'plans', 'sort' => 'ordvlp', 'expected' => true],

            'shouldBeTrueWhenPaymentsFooEqual' => ['local' => 'payments', 'sort' => 'foo', 'expected' => false],
            'shouldBeTrueWhenPaymentsIdclientEqual' => ['local' => 'payments', 'sort' => 'ordid', 'expected' => true],
            'shouldBeTrueWhenPaymentsDesclientEqual' => ['local' => 'payments', 'sort' => 'ordcli', 'expected' => true],
            'shouldBeTrueWhenPaymentsIdplanEqual' => ['local' => 'payments', 'sort' => 'ordpla', 'expected' => true],
            'shouldBeTrueWhenPaymentsQtdpayEqual' => ['local' => 'payments', 'sort' => 'ordqtd', 'expected' => true],

            'shouldBeTrueWhenDetailsFooEqual' => ['local' => 'detail', 'sort' => 'foo', 'expected' => false],
            'shouldBeTrueWhenDetailsIdpaymentEqual' => ['local' => 'detail', 'sort' => 'ordid', 'expected' => true],
            'shouldBeTrueWhenDetailsIdclientEqual' => ['local' => 'detail', 'sort' => 'ordcli', 'expected' => true],
            'shouldBeTrueWhenDetailsIdplanEqual' => ['local' => 'detail', 'sort' => 'ordpla', 'expected' => true],
            'shouldBeTrueWhenDetailsVlrecurrenceEqual' => ['local' => 'detail', 'sort' => 'ordrec', 'expected' => true],
            'shouldBeTrueWhenDetailsDtpaymentEqual' => ['local' => 'detail', 'sort' => 'orddtp', 'expected' => true],
            'shouldBeTrueWhenDetailsVlpaymentEqual' => ['local' => 'detail', 'sort' => 'ordvlp', 'expected' => true]
        ];
    }
}
