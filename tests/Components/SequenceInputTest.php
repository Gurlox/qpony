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

    public function invokeMethod(string $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class(self::$sequenceInput));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs(self::$sequenceInput, $parameters);
    }

    public function testSetInputsExceptions()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->invokeMethod("validateInput", [[2, 3, 4, '4huhi']]);

        $this->expectException(\InvalidArgumentException::class);
        $this->invokeMethod("validateInput", [[-1, 2]]);

        $this->expectException(\InvalidArgumentException::class);
        $this->invokeMethod("validateInput", [[2, 999999]]);
    }

    public function testSetAndGetInputsAsArray()
    {
        $result = [2, 3, 4, 43];
        self::$sequenceInput->setInputs(EOL::stringWithEOL(implode(' ', $result)));
        $this->assertEquals($result, self::$sequenceInput->getInputsAsArray());

        self::$sequenceInput->setInputsAsArray($result);
        $this->assertEquals($result, self::$sequenceInput->getInputsAsArray());
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
