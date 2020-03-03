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
    public function GetOrder($local, $sort, $expected)
    {
        $result = Order::getOrder($local, $sort);

        $this->assertEquals($expected, $result);
    }

    public function valueProvider()
    {
        return [
            'shouldBeTrueWhenFooFooEqual' => ['local' => 'foo', 'sort' => 'foo', 'expected' => 'foo foo'],

            'shouldBeTrueWhenPlansFooEqual' => ['local' => 'plans', 'sort' => 'foo', 'expected' => 'foo DESC'],
            'shouldBeTrueWhenPlansIdplanDEqual' => ['local' => 'plans', 'sort' => 'ordid', 'expected' => 'idplan ASC'],
            'shouldBeTrueWhenPlansDesplanEqual' => ['local' => 'plans', 'sort' => 'ordplan', 'expected' => 'desplan ASC'],
            'shouldBeTrueWhenPlansVlplanEqual' => ['local' => 'plans', 'sort' => 'ordvlp', 'expected' => 'vlplan ASC'],

            'shouldBeTrueWhenPaymentsFooEqual' => ['local' => 'payments', 'sort' => 'foo', 'expected' => 'foo ASC'],
            'shouldBeTrueWhenPaymentsIdclientEqual' => ['local' => 'payments', 'sort' => 'ordid', 'expected' => 'a.idclient ASC'],
            'shouldBeTrueWhenPaymentsDesclientEqual' => ['local' => 'payments', 'sort' => 'ordcli', 'expected' => 'a.idclient ASC'],
            'shouldBeTrueWhenPaymentsIdplanEqual' => ['local' => 'payments', 'sort' => 'ordpla', 'expected' => 'a.idplan ASC'],
            'shouldBeTrueWhenPaymentsQtdpayEqual' => ['local' => 'payments', 'sort' => 'ordqtd', 'expected' => 'qtdpay ASC'],

            'shouldBeTrueWhenDetailsFooEqual' => ['local' => 'detail', 'sort' => 'foo', 'expected' => 'foo ASC'],
            'shouldBeTrueWhenDetailsIdpaymentEqual' => ['local' => 'detail', 'sort' => 'ordid', 'expected' => 'a.idpayment ASC'],
            'shouldBeTrueWhenDetailsIdclientEqual' => ['local' => 'detail', 'sort' => 'ordcli', 'expected' => 'a.idclient ASC'],
            'shouldBeTrueWhenDetailsIdplanEqual' => ['local' => 'detail', 'sort' => 'ordpla', 'expected' => 'a.idplan ASC'],
            'shouldBeTrueWhenDetailsVlrecurrenceEqual' => ['local' => 'detail', 'sort' => 'ordrec', 'expected' => 'a.vlrecurrence ASC'],
            'shouldBeTrueWhenDetailsDtpaymentEqual' => ['local' => 'detail', 'sort' => 'orddtp', 'expected' => 'a.dtpayment ASC'],
            'shouldBeTrueWhenDetailsVlpaymentEqual' => ['local' => 'detail', 'sort' => 'ordvlp', 'expected' => 'a.vlpayment ASC']
        ];
    }
}
