<?php

namespace App\Command;

use App\Components\SequenceInput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SequenceCommand extends Command
{
    protected static $defaultName = 'app:sequence:highest-values';

    protected function configure()
    {
        $this
            ->setDescription('Displays highest sequence value for each input.')
            ->addArgument(
                'inputs',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'Inputs (space separated)'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sequenceInput = (new SequenceInput())->setInputsAsArray($input->getArgument('inputs'));

        foreach ($sequenceInput->highestValuesOutput() as $item) {
            $output->writeln($item['input'] . ' => ' . $item['output']);
        }
    }
}
