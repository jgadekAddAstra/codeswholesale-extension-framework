<?php

namespace CodesWholesaleFramework\Postback\UpdatePriceAndStock;
/**
 *   This file is part of codeswholesale-plugin-framework.
 *
 *   codeswholesale-plugin-framework is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   codeswholesale-plugin-framework is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with codeswholesale-plugin-framework; if not, write to the Free Software
 *   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
use CodesWholesale\Client;
use CodesWholesaleFramework\Action;
use CodesWholesaleFramework\Postback\Retriever\SpreadRetriever;
use CodesWholesale\Resource\Product;
use CodesWholesale\Resource\ResourceError;

/**
 * Class UpdatePriceAndStockAction
 */
class UpdatePriceAndStockAction implements Action
{
    /**
     * @var ProductUpdater
     */
    private $productUpdater;

    /**
     * @var Client
     */
    private $connection;

    /**
     * @var string|null
     */
    private $cwProductId;

    /**
     * @var SpreadRetriever
     */
    private $spreadParams;

    /**
     * @var SpreadCalculator
     */
    private $spreadCalculator;


    /**
     * UpdatePriceAndStockAction constructor.
     *
     * @param $productUpdater
     * @param SpreadRetriever $spreadParams
     */
    public function __construct($productUpdater, $spreadParams)
    {
        $this->productUpdater = $productUpdater;

        $this->spreadParams = $spreadParams;

        $this->spreadCalculator = new SpreadCalculator();
    }

    /**
     * @throws \HttpRequestException
     */
    public function process()
    {
        if (null == $this->cwProductId) {

            $request = file_get_contents('php://input');

            if (empty($request)) {
                throw new \HttpRequestException('No request data', 400);
            }

            $this->setProductId($this->connection->receiveUpdatedProductId());

        }

        try {

            $product = Product::get($this->cwProductId);

        } catch (ResourceError $e) {

            throw new \HttpRequestException("Received product id: " . $this->cwProductId . " Error: " . $e->getMessage(), 400);
        }

        $quantity = $product->getStockQuantity();

        /** @var float $price */
        $price = $product->getLowestPrice();

        $priceSpread = $this->spreadCalculator->calculateSpread($this->spreadParams->getSpreadParams(''), $price);

        $this->productUpdater->updateProduct($this->cwProductId, $quantity , $priceSpread, $price);
    }

    /**
     * @param $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $cwProductId
     */
    public function setProductId($cwProductId)
    {
        $this->cwProductId = $cwProductId;
    }
}