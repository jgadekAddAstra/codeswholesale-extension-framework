<?php

require_once __DIR__ . '/dummies/TestProductUpdater.php';
require_once __DIR__ . '/dummies/TestSpreadRetriever.php';
require_once __DIR__ . '/dummies/TestConnection.php';
require_once __DIR__ . '/dummies/TestProductRetriever.php';

use CodesWholesaleFramework\Postback\UpdatePriceAndStock\UpdatePriceAndStockAction;
use CodesWholesaleFramework\Postback\UpdatePriceAndStock\SpreadCalculatorImpl;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 10/06/16
 * Time: 15:13
 */
class UpdatePriceAndStockTest extends TestCase
{
    const INPUT_FILE = __DIR__ . '/dummies/TestInput.txt';

    private $productUpdater;

    private $connection;

    private $spreadCalculator;

    public function setUp()
    {
        parent::setUp();
        $this->productUpdater = new TestProductUpdater();
        $this->connection = new TestConnection();
        $this->spreadCalculator = new SpreadCalculatorImpl();
    }

    public function testShouldUpdateProductPriceWithConstantValue() {

        $updater = new UpdatePriceAndStockAction (
            $this->productUpdater,
            new TestSpreadRetriever(0, 23.0),
            new TestProductRetriever('ffe2274d-5469-4b0f-b57b-f8d21b09c24c', 'Test Product', 2.0, 2, 'Origin', 'http'),
            $this->spreadCalculator,
            $this->connection
        );
        $updater->input = self::INPUT_FILE;

        $updatedProduct = $updater->process();

        $this->assertEquals('ffe2274d-5469-4b0f-b57b-f8d21b09c24c', $updatedProduct->getId());
        $this->assertEquals('Test Product', $updatedProduct->getTitle());
        $this->assertEquals(25, $updatedProduct->getPrice());
        $this->assertEquals(2, $updatedProduct->getStock());
        $this->assertEquals('Origin', $updatedProduct->getPlatform());
        $this->assertEquals('http', $updatedProduct->getImageUrl());
    }

    public function testShouldUpdateProductPriceWithPercentValue() {

        $updater = new UpdatePriceAndStockAction (
            $this->productUpdater,
            new TestSpreadRetriever(1, 10.0),
            new TestProductRetriever('ffe2274d-5469-4b0f-b57b-f8d21b09c24c', 'Test Product', 2.0, 43, 'Origin', 'http'),
            $this->spreadCalculator,
            $this->connection
        );
        $updater->input = self::INPUT_FILE;

        $updatedProduct = $updater->process();

        $this->assertEquals('ffe2274d-5469-4b0f-b57b-f8d21b09c24c', $updatedProduct->getId());
        $this->assertEquals('Test Product', $updatedProduct->getTitle());
        $this->assertEquals(2.2, $updatedProduct->getPrice());
        $this->assertEquals(43, $updatedProduct->getStock());
        $this->assertEquals('Origin', $updatedProduct->getPlatform());
        $this->assertEquals('http', $updatedProduct->getImageUrl());
    }
}