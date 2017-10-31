<?php

use CodesWholesaleFramework\Postback\UpdatePriceAndStock\SpreadCalculatorImpl;
use CodesWholesaleFramework\Exceptions\InvalidSpreadTypeException;
use CodesWholesaleFramework\Domain\SpreadData;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 06/06/16
 * Time: 17:42
 */
class SpreadCalculatorTest extends TestCase
{
    /**
     * @var SpreadCalculatorImpl
     */
    private $calculator;

    public function setUp()
    {
        parent::setUp();
        $this->calculator = new SpreadCalculatorImpl();
    }

    public function testShouldCountConstantValue()
    {
        $spreadData = new SpreadData(0, 20.00);
        $calculatedPrice = $this->calculator->calculateSpread($spreadData, 23);

        $this->assertEquals(43, $calculatedPrice);
    }

    public function testShouldCountPercentValue()
    {
        $spreadData = new SpreadData(1, 20.00);
        $calculatedPrice = $this->calculator->calculateSpread($spreadData, 23);

        $this->assertEquals(27.6, $calculatedPrice);
    }

    /**
     * @throws InvalidSpreadTypeException
     */
    public function testShouldThrowInvalidSpreadTypeException()
    {
        $this->setExpectedException(InvalidSpreadTypeException::class);

        $spreadData = new SpreadData(4, 20.00);
        $this->calculator->calculateSpread($spreadData, 23);

        $this->assertEquals(InvalidSpreadTypeException::class, $this->getExpectedException());
    }

    /**
     * @throws InvalidSpreadTypeException
     */
    public function testShouldThrowExceptionWhileReceivingStringValue()
    {
        $this->setExpectedException(InvalidSpreadTypeException::class);

        $spreadData = new SpreadData("4", 20.00);
        $this->calculator->calculateSpread($spreadData, 23);

        $this->assertEquals(InvalidSpreadTypeException::class, $this->getExpectedException());
    }
}