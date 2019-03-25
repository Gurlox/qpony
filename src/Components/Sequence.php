<?php

namespace App\Components;

abstract class Sequence
{
    protected $storage = [
        0 => 0,
        1 => 1
    ];

    private function setValue(int $i): int
    {
        if ($i < 0) throw new \InvalidArgumentException('iterator cannot be negative number');

        if (!isset($this->storage[$i])) {
            if ($i % 2 == 0) {
                $this->storage[$i] = $this->setValue($i / 2);
            } else {
                $division = ($i - 1) / 2;
                $this->storage[$i] = $this->setValue($division) + $this->setValue($division + 1);
            }
        }

        return $this->storage[$i];
    }


    public function getHighestValue(int $n): int
    {
        if ($n < 0) throw new \InvalidArgumentException('Bad value provided');

        $highest = 0;
        for ($i = 0; $i <= $n; $i++) {
            $value = $this->setValue($i);
            if ($value > $highest) {
                $highest = $value;
            }
        }

        return $highest;
    }
}
