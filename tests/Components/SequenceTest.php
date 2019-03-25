<?php

namespace App\Tests\Util;

use App\Components\Sequence;
use PHPUnit\Framework\TestCase;

class SequenceTest extends TestCase
{
    private $sequence;

    protected function setUp()
    {
        $this->sequence = new class extends Sequence {
            public function getThis()
            {
                return $this;
            }
        };
    }

    public function testAbstractClassMethod()
    {
        $this->assertInstanceOf(
            Sequence::class,
            $this->sequence->getThis()
        );
    }

    public function invokeMethod(string $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($this->sequence));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($this->sequence, $parameters);
    }

    public function testSetValue()
    {
        $this->assertEquals(1, $this->invokeMethod("setValue", [8]));
        $this->assertEquals(5, $this->invokeMethod("setValue", [11]));
        $this->assertEquals(1, $this->invokeMethod("setValue", [2]));
        $this->assertEquals(0, $this->invokeMethod("setValue", [0]));

        $this->expectException(\InvalidArgumentException::class);
        $this->invokeMethod("setValue", [-1]);
    }

    public function testGetHighestValue()
    {
        $this->assertEquals(3, $this->sequence->getHighestValue(5));
        $this->assertEquals(4, $this->sequence->getHighestValue(10));

        $this->expectException(\InvalidArgumentException::class);
        $this->sequence->getHighestValue(-1);
    }
}
