<?php

namespace SCE\Control\Test;

use PHPUnit\Framework\TestCase;
use SCE\Control\Message;

class MessageTest extends TestCase
{
    /**
     * @test
     */
    public function shoulBeTrueWhenSetErrorEqual()
    {
        $msg = Message::setError("foo");

        $this->assertEquals("foo", $msg);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetErrorEqual()
    {
        $msg = Message::getError();

        $this->assertEquals("foo", $msg);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenSetSuccessEqual()
    {
        $msg = Message::setSuccess("foo");

        $this->assertEquals("foo", $msg);
    }

    /**
     * @test
     */
    public function shoulBeTrueWhenGetSuccessEqual()
    {
        $msg = Message::getSuccess();

        $this->assertEquals("foo", $msg);
    }
}
