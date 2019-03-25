<?php

namespace App\Tests\Test;

use App\Test\EOL;
use PHPUnit\Framework\TestCase;

class EOLTest extends TestCase
{
    public function testStringWithEOL()
    {
        $this->assertEquals(
            '1' . PHP_EOL . '2' . PHP_EOL . '3',
            EOL::stringWithEOL('1 2 3')
        );
    }
}
