<?php
namespace phpreboot\tddworkshop;

class Calculator
{
    /**
     * get sum of numbers
     * 
     * @param string $numbers
     * @return integer
     */
    public function add($numbers = '')
    {
        $result = $this->generateParams($numbers);
        
        if (is_array($result)) {
            return array_sum($result);
        }
        return $result;
    }
    
    /**
     * get product of numbers
     * 
     * @param string $numbers
     * @return integer
     */
    public function product($numbers = '')
    {
        $result = $this->generateParams($numbers);
        
        if (is_array($result)) {
            return array_product($result);
        }
        return $result;
        
    }
    
    /**
     * Get array removing delimiter , less than 1000
     * 
     * @param string $numbers
     * @return int
     * @throws \InvalidArgumentException
     */
    public function generateParams($numbers) {
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
            $negativeNumbers = array_filter($numbersArray, function ($v) {return $v < 0;});
            throw new \InvalidArgumentException('Negative numbers ('. implode(',',$negativeNumbers).')not allowed');
        }
        
        return array_filter($numbersArray, function ($v) {return $v < 1000;}); 
    }
}