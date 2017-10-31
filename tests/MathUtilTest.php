<?php

use CodesWholesaleFramework\Utils\MathUtil;
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 09/06/16
 * Time: 10:59
 */
class MathUtilTest extends TestCase
{

    /**
     * @var \CodesWholesaleFramework\Utils\MathUtil
     */
    private $mathUtil;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->mathUtil = new MathUtil();
    }

    public function testShouldAddTwoVariables()
    {
        $result = $this->mathUtil->addTwoNumbers(4, 9);
        $this->assertEquals(13, $result);
    }

    public function testShouldAddTwoStrings()
    {
        $result = $this->mathUtil->addTwoNumbers("4", "9");
        $this->assertEquals(13, $result);
    }
    
}