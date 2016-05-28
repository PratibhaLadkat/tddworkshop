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
        $delimiters = array("\r\n","\r","\n","\\r","\\n","\\r\\n",'\\;','\\',';');
        
        $numbers = str_replace($delimiters,",",$numbers);
        $numbersArray = array_filter(explode(",", $numbers));
        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }
        if (array_filter($numbersArray, function ($v) {return $v > 0;}) !== $numbersArray) {
            throw new \InvalidArgumentException('Negative numbers not allowed');
        }
        return array_sum($numbersArray);
    }
}