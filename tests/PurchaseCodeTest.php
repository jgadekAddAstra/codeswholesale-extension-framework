<?php

use \CodesWholesaleFramework\Orders\Codes\PurchaseCode;
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 23/06/16
 * Time: 11:17
 */
class PurchaseCodeTest extends TestCase
{
    private $code;

    private $codeList;

    private $externalOrder;

    private $externalProduct;

    /**
     * @var PurchaseCode
     */
    private $purchaser;

    public function setUp()
    {
        parent::setUp();
        $this->code = $this->getMockBuilder(\CodesWholesaleFramework\Domain\ExternalCodes::class)->getMock();
        $this->codeList = $this->getMockBuilder(\CodesWholesaleFramework\Postback\ExternalCodeList::class)->getMock();
        $this->externalOrder = $this->getMockBuilder(\CodesWholesaleFramework\Domain\ExternalOrder::class)->getMock();
        $this->externalProduct = $this->getMockBuilder(\CodesWholesaleFramework\Mappers\ExternalProduct::class)->getMock();
        $this->purchaser = new PurchaseCode($this->externalOrder);

        /** CODE LIST */
        $this->codeList->method('getCodes')->willReturn([0 => $this->code]);
        $this->codeList->method('getOrderId')->willReturn(32);

        /** EXTERNAL ORDER */
        $this->externalOrder->method('createBatchOrder')->willReturn($this->codeList);
    }
    
    public function testShouldPurchaseCode() {

        $this->code->method('isPreOrder')->willReturn(0);
        $purchasedCode = $this->purchaser->purchase($this->externalProduct, 1);

        $this->assertEquals($purchasedCode->getOrderId(), 32);
        $this->assertEquals($purchasedCode->getNumberOfPreOrders(), 0);
        $this->assertNotNull($purchasedCode->getLinks());
        $this->assertNotNull($purchasedCode->getOrderDate());
    }

    public function testShouldOrderPreOrder() {

        $this->code->method('isPreOrder')->willReturn(1);
        $purchasedCode = $this->purchaser->purchase($this->externalProduct, 1);

        $this->assertEquals($purchasedCode->getNumberOfPreOrders(), 1);
    }
}