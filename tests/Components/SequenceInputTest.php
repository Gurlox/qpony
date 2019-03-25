<?php

namespace App\Tests\Util;

use App\Components\SequenceInput;
use PHPUnit\Framework\TestCase;

class SequenceInputTest extends TestCase
{
    /** @var SequenceInput $sequenceInput */
    private static $sequenceInput;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$sequenceInput = new SequenceInput();
    }

    public function testSetInputsExceptions()
    {
        $this->expectException(\InvalidArgumentException::class);
        self::$sequenceInput->setInputs('2\n3\n4\n4uhuih');
        $this->expectException(\InvalidArgumentException::class);
        self::$sequenceInput->setInputs('-1\n2');
        $this->expectException(\InvalidArgumentException::class);
        self::$sequenceInput->setInputs('2\n999999');
    }

    public function testSetAndGetInputs()
    {
        self::$sequenceInput->setInputs('2\n3\n4\n43');
        $this->assertEquals([2, 3, 4, 43], self::$sequenceInput->getInputs());
    }

    public function testHighestValuesOutput()
    {
        self::$sequenceInput->setInputs('5\n10');
        $this->assertEquals(
            [
                ['input' => 5, 'output' => 3],
                ['input' => 10, 'output' => 4],
            ],
            self::$sequenceInput->highestValuesOutput()
        );
    }
}
