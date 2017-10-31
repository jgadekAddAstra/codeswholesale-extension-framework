<?php

use \CodesWholesaleFramework\Postback\Retriever\ItemRetriever;
use \CodesWholesaleFramework\Postback\ReceivePreOrders\ReceivePreOrdersAction;
use \CodesWholesaleFramework\Postback\ReceivePreOrders\EventDispatcher;
use \CodesWholesaleFramework\Postback\Extractor\NewKeysExtractor;
use \CodesWholesaleFramework\Postback\ReceivePreOrders\ExternalOrder;
use \CodesWholesaleFramework\Connection\Client;
use \CodesWholesaleFramework\Postback\InternalProduct;
use \CodesWholesaleFramework\Domain\ExtractedKeys;
use \CodesWholesale\Resource\CodeList;
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 20/06/16
 * Time: 12:35
 */
class ReceivePreOrdersTest extends TestCase
{
    const INPUT_FILE = __DIR__ . '/dummies/TestInput.txt';

    private $itemRetriever;

    private $preOrderEventDispatcher;

    private $keysExtractor;

    private $externalOrder;

    private $connection;

    public function setUp()
    {
        parent::setUp();
        $this->itemRetriever = $this->getMockBuilder(ItemRetriever::class)->getMock();
        $this->preOrderEventDispatcher = $this->getMockBuilder(EventDispatcher::class)->getMock();
        $this->keysExtractor = $this->getMockBuilder(NewKeysExtractor::class)->getMock();
        $this->connection = $this->getMockBuilder(Client::class)->getMock();
        $this->externalOrder = $this->getMockBuilder(ExternalOrder::class)->getMock();
    }

    public function testShouldReturnReceivedPreOrder() {

//        $this->itemRetriever->method('retrieveItem')
//            ->willReturn(InternalProduct::class);
//
//        $this->preOrderEventDispatcher->method('dispatchEvent')
//            ->willReturn(true);
//
//        $this->keysExtractor->method('extract')
//            ->willReturn(ExtractedKeys::class);
//
//        $this->connection->method('receiveProductOrdered')
//            ->willReturn();
//
//        $this->externalOrder->method('getCodes')
//            ->willReturn(CodeList::class);
//
//        $receiver = new ReceivePreOrdersAction(
//            $this->itemRetriever,
//            $this->preOrderEventDispatcher,
//            $this->keysExtractor,
//            $this->externalOrder,
//            $this->connection
//        );
//
//        $receiver->input = self::INPUT_FILE;
//        $receiver->process();
//
//        $this->assertTrue(true);
    }
}