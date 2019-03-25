<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class SequenceCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $result = [
            'input' => [5, 10],
            'output' => [3, 4]
        ];

        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:sequence:highest-values');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'inputs' => $result['input']
        ]);

        $output = $commandTester->getDisplay();
        foreach ($result['input'] as $key => $item) {
            $this->assertContains($item . ' => ' . $result['output'][$key], $output);
        }
    }
}
