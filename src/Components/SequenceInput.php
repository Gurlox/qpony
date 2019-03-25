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

    public function getInputs(): string
    {
        return implode(PHP_EOL, $this->inputs);
    }

    public function getInputsAsArray(): array
    {
        return $this->inputs;
    }

    public function setInputs(string $inputs): self
    {
        $inputs = preg_replace("/\\r/", "", $inputs);
        $inputs = explode(PHP_EOL, $inputs);
        $this->validateInput($inputs);

        return $this;
    }

    public function setInputsAsArray(array $inputs): self
    {
        $this->validateInput($inputs);

        return $this;
    }

    private function validateInput(array $inputs): void
    {
        foreach ($inputs as &$input) {
            if (!is_numeric($input)) throw new \InvalidArgumentException('All values should be numeric');
            $input = (int)$input;
            if ($input < 1) throw new \InvalidArgumentException('Value cannot be less than 1');
            if ($input > 99999) throw new \InvalidArgumentException('Value cannot be more than 99 999');
        }
        $this->inputs = $inputs;
    }
}
