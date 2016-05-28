<?php
namespace phpreboot\tddworkshop;

class Calculator
{
    public function add($numbers = '')
    {
        if (empty($numbers)) {
            return 0;
        }

        if (!is_string($numbers)) {
            throw new \InvalidArgumentException('Parameters must be a string');
        }

        $numbersArray = explode(",", $numbers);

        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }

        return array_sum($numbersArray);
    }
}