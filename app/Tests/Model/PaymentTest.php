<?php

namespace SCE\Tests\Model;

use PHPUnit\Framework\TestCase;
use SCE\Model\Payment;

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
    public function shoulBeTrueWhenInstanciateClass()
    {
        $this->assertInstanceOf(Payment::class, new Payment());
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenCheckPaymentNotEmpty()
    {
        $value = Payment::checkPayment(0);

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

        $data = Payment::listPaymentPage($list, true);

        $this->assertEquals('Empresa 0', $data[0]['desclient']);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSavePaymentCount()
    {
        $value = $this->payment->save(0);

        $this->assertCount(6, $value[0]);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPaymentCount()
    {
        $value = $this->payment->get(1);

        $this->assertCount(6, $value[0]);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenDeletePaymentTrue()
    {
        $value = $this->payment->delete();

        $this->assertTrue($value);
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
