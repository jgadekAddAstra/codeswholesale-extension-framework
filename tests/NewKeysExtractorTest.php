<?php

use \CodesWholesaleFramework\Postback\ReceivePreOrders\NewKeysExtractorImpl;
use \CodesWholesaleFramework\Postback\ImageWriter;
use \CodesWholesaleFramework\Postback\InternalProduct;
use \CodesWholesaleFramework\Domain\Code;
use \CodesWholesaleFramework\Postback\ExternalCodeList;
use \CodesWholesaleFramework\Domain\ExtractedKeys;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 21/06/16
 * Time: 14:56
 */
class NewKeysExtractorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testShouldReturnExtractedKeys() {

        $imageWriter = $this->getMockBuilder(ImageWriter::class)->getMock();
        $imageWriter->method('write')
            ->willReturn('/custom/path');

        $product = $this->getMockBuilder(InternalProduct::class)->getMock();
        $product->method('getLinks')
            ->willReturn('["https:\/\/api.codeswholesale.com\/v1\/orders\/a30825dd-e21e-42d7-a856-4a88f973ec78\/productsOrdered\/24038c67-5c6a-463e-ae6a-5d574cb691e6\/codes\/a1903d8c-49f5-4f94-8c7a-a6d32d64837e","https:\/\/api.codeswholesale.com\/v1\/orders\/a30825dd-e21e-42d7-a856-4a88f973ec78\/productsOrdered\/24038c67-5c6a-463e-ae6a-5d574cb691e6\/codes\/db31148c-2157-4756-9874-7c57b454dca3"]');
        $product->method('getNumberOfPreOrders')
            ->willReturn(2);
        
        $code1 = $this->getMockBuilder(Code::class)->getMock();
        $code1->method('isImage')
            ->willReturn(false);
        $code1->method('getHref')
            ->willReturn('http://example.com');

        $code2 = $this->getMockBuilder(Code::class)->getMock();
        $code2->method('isImage')
            ->willReturn(true);
        $code2->method('getHref')
            ->willReturn('http://example.com');

        $codeList = array(
            0 => $code1,
            1 => $code2
        );

        $externalCodeList = $this->getMockBuilder(ExternalCodeList::class)->getMock();
        $externalCodeList->method('getCodes')
        ->willReturn($codeList);

        $extractor = new NewKeysExtractorImpl($imageWriter);
        $extractedKeys = $extractor->extract($product, $externalCodeList);

        $this->assertInstanceOf(ExtractedKeys::class, $extractedKeys);
        $this->assertEquals($extractedKeys->getPreOrdersLeft(), 2);
        $this->assertEquals($extractedKeys->getTotalNumberOfPreOrders(), 2);
    }
}