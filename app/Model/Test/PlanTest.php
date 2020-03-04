<?php

namespace SCE\Model\Test;

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

        $this->assertCount(1, $value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSavePlanEmpty()
    {
        $value = $this->plan->save();

        $this->assertEmpty($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPlanEqual()
    {
        $value = $this->plan->get(1);

        $this->assertEquals(3, count($value[0]));
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenDeletePlanNull()
    {
        $value = $this->plan->delete();

        $this->assertNull($value);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetPlanPageCount()
    {
        $value = $this->plan->getPlanPage("a.idplan ASC", 1, 1);

        $this->assertCount(3, $value);
    }
}
