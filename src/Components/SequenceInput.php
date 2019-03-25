<?php

namespace App\Components;

class SequenceInput extends Sequence
{
    private $inputs = [];

    public function highestValuesOutput(): array
    {
        $highestValues = [];
        foreach ($this->inputs as $input) {
            $highestValues[] = [
                'input' => $input,
                'output' => $this->getHighestValue($input)
            ];
        }

        return $highestValues;
    }

    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function setInputs(string $inputs): self
    {
        $inputs = explode('\n', $inputs);
        foreach ($inputs as &$input) {
            if (!is_numeric($input)) throw new \InvalidArgumentException('All values should be numeric');
            $input = (int)$input;
            if ($input < 1) throw new \InvalidArgumentException('Value cannot be less than 1');
            if ($input > 99999) throw new \InvalidArgumentException('Value cannot be more than 99 999');
        }
        $this->inputs = $inputs;

        return $this;
    }
}