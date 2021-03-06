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
    
    /**
     * Testcase for multiple parameter
     * 
     * @dataProvider dataProviderForMultipleParameter
     */
    public function testAddWithMultiParametersReturnsTheirSum($params, $expectedResult)
    {
        $result = $this->calculator->add($params);

        $this->assertSame($expectedResult, $result, 'Add with two parameter do not returns correct sum');
    }
   
    /**
     * Data provider for multipple parameter
     * 
     * @return array
     */
    public function dataProviderForMultipleParameter()
    {
        return array(
            array('2,3', 5),
            array('4,5,6', 15),
            array('2,3,4,5', 14),
            array('4,7,3,4,7,3,5,6,7,4,3,2,5,7,5,3,4,6,7,8,9,5,5,5,4,3,2', 133),
            array('2,3,4,5', 14),
        );
    }
    
    /**
     * @dataProvider dataProviderForMultipleParameterWithMultiDelimiter
     */
    public function testAddWithMultiParametersWithDiffernetDelimiter($params, $expectedResult)
    {
       $result = $this->calculator->add($params);

        $this->assertSame($expectedResult, $result, 'Add with multiple parameters with mutiple delimiters do not returns correct sum');  
    }
    
    /**
     * Data provider for multipple parameter with multiple delimiters
     * 
     * @return array
     */
    public function dataProviderForMultipleParameterWithMultiDelimiter()
    {
        return array(
            array('\\;\\3;4;5', 12),
            array('4;5;6', 15),
            array('2;3;4;5', 14),
            array('4;7;3;4;7;3;5,6,7,4,3,2,5,7,5,3,4,6,7,8,9,5,5,5,4,3,2', 133),
            array('2\n3,4,5', 14),
        );
    }
    
    /**
     * Testcase to test negative param
     * 
     * @expectedException InvalidArgumentException
     * 
     */
    public function testAddWithNegativeParameter()
    {
        $result = $this->calculator->add('\\,\\2,7,-3,5,-2');
    }
    
    /**
     * @dataProvider dataProviderForProduct
     */
    public function testProductWithMultiParametersWithDiffernetDelimiter($params, $expectedResult)
    {
        $result = $this->calculator->product($params);

        $this->assertSame($expectedResult, $result, 'product not correct');  
    }
    
    /**
     * Data provider for multiplication
     * @return array
     */
    public function dataProviderForProduct()
    {
        return array(
            array('10,20', 200),
            array('4;5;6', 120),
            array('2;3;1000', 6),
        );
    }
}