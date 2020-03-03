<?php

namespace SCE\Model;

use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    private $payment;

    public function setUp()
    {
        $this->payment = new Payment();
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenCheckPaymentNotEmpty()
    {
        $value = $this->payment->checkPayment(0);

        $this->assertNotEmpty($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenListPaymentPageEqual()
    {
        $list = [
            '0' => [
                'idpayment' => "2",
                'idclient' => "0",
                'dtpayment' => "2019-05-12",
                'idplan' => "1",
                'vlrecurrence' => "6",
                'vlpayment' => "600.00",
                'qtdpay' => "14",
                'desplan' => "Bronze",
                'vlplan' => "100.00"
            ]
        ];

        $data = $this->payment->listPaymentPage($list, true);

        $this->assertEquals('Empresa 0', $data[0]['desclient']);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSavePaymentEmpty()
    {
        $value = $this->payment->save();

        $this->assertEmpty($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPaymentEqual()
    {
        $value = $this->payment->get(1);

        $this->assertEquals(6, count($value[0]));
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenDeletePaymentNull()
    {
        $value = $this->payment->delete();

        $this->assertNull($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPaymentPageCount()
    {
        $value = $this->payment->getPaymentPage("a.idpayment ASC", 1, 1, true);

        $this->assertCount(3, $value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPaymentClientPageCount()
    {
        $value = $this->payment->getPaymentClientPage("a.idpayment ASC", 0, 1, 1, true);

        $this->assertCount(3, $value);
    }
}
