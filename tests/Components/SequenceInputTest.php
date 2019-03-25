<?php

namespace App\Tests\Util;

use App\Components\SequenceInput;
use App\Test\EOL;
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
        self::$sequenceInput->setInputs(EOL::stringWithEOL('2 3 4 4uhuih'));
        $this->expectException(\InvalidArgumentException::class);
        self::$sequenceInput->setInputs(EOL::stringWithEOL('-1 2'));
        $this->expectException(\InvalidArgumentException::class);
        self::$sequenceInput->setInputs(EOL::stringWithEOL('2 999999'));
    }

    public function testSetAndGetInputsAsArray()
    {
        self::$sequenceInput->setInputs(EOL::stringWithEOL('2 3 4 43'));
        $this->assertEquals([2, 3, 4, 43], self::$sequenceInput->getInputsAsArray());
    }

    public function testSetAndGetInputs()
    {
        $value = EOL::stringWithEOL('2 3 4 43');
        self::$sequenceInput->setInputs($value);
        $this->assertEquals($value, self::$sequenceInput->getInputs());
    }

    public function testHighestValuesOutput()
    {
        self::$sequenceInput->setInputs(EOL::stringWithEOL('5 10'));
        $this->assertEquals(
            [
                ['input' => 5, 'output' => 3],
                ['input' => 10, 'output' => 4],
            ],
            self::$sequenceInput->highestValuesOutput()
        );
    }
}
