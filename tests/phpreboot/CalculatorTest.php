<?php
namespace phpreboot\tddworkshop;

use phpreboot\tddworkshop\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function tearDown()
    {
        $this->calculator = null;
    }

    /**
     * Testcase to check return value is integer or not
     * 
     */
    public function testAddReturnsAnInteger()
    {
        $result = $this->calculator->add();

        $this->assertInternalType('integer', $result, 'Result of `add` is not an integer.');
    }
    
    /**
     * Testcase to check if no parameter passed then zero will be return
     */
    public function testAddWithoutParameterReturnsZero()
    {
        $result = $this->calculator->add();
        $this->assertSame(0, $result, 'Empty string on add do not return 0');
    }
    
    /**
     * Testcase to check if single no pass it should return same number
     */
    public function testAddWithSingleNumberReturnsSameNumber()
    {
        $result = $this->calculator->add('3');
        $this->assertSame(3, $result, 'Add with single number do not returns same number');
    }
    
    /**
     * tescase to check sum is correct or not
     */
    public function testAddWithTwoParametersReturnsTheirSum()
    {
        $result = $this->calculator->add('2,4');

        $this->assertSame(6, $result, 'Add with two parameter do not returns correct sum');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function  testAddWithNonStringParameterThrowsException()
    {
        $this->calculator->add(5, 'Integer parameter do not throw error');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNonNumbersThrowException()
    {
        $this->calculator->add('1,a', 'Invalid parameter do not throw exception');
    }
}