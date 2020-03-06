<?php

namespace SCE\Tests\Model;

use PHPUnit\Framework\TestCase;
use SCE\Model\Plan;

class PlanTest extends TestCase
{
    private $plan;

    public function setUp()
    {
        $this->plan = new Plan();
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenInstanciateClass()
    {
        $this->assertInstanceOf(Plan::class, new Plan());
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSelectPlanCount()
    {
        $value = Plan::selectPlan();

        $this->assertCount(4, $value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenCheckPlanEmpty()
    {
        $value = Plan::checkPlan(0);

        $this->assertEmpty($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenListPlanPageCount()
    {
        $content = [
            [
                "foo0" => 'foo',
                "foo1" => 'foo',
                "foo2" => 'foo'
            ]
        ];

        $value = Plan::listPlanPage($content);

        $this->assertCount(3, $value[0]);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSavePlanCount()
    {
        $value = $this->plan->save(0);

        $this->assertCount(3, $value[0]);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPlanCount()
    {
        $value = $this->plan->get(1);

        $this->assertCount(3, $value[0]);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenDeletePlanTrue()
    {
        $value = $this->plan->delete();

        $this->assertTrue($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPlanPage()
    {
        $value = $this->plan->getPlanPage("a.idplan ASC", 1, 1);

        $this->assertEmpty($value['data']);
        $this->assertCount(3, $value);
    }
}
