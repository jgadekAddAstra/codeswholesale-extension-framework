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
use CodesWholesaleFramework\Action;
use CodesWholesale\Resource\ResourceError;
use CodesWholesaleFramework\Connection\Client;
use CodesWholesaleFramework\Exceptions\ProductIdIsSetException;
use CodesWholesaleFramework\Mappers\ExternalProduct;
use CodesWholesaleFramework\Mappers\ProductMapper;
use CodesWholesaleFramework\Postback\PostBack;
use CodesWholesaleFramework\Postback\Retriever\ExternalProductRetriever;
use CodesWholesaleFramework\Postback\Retriever\SpreadRetriever;
use \CodesWholesaleFramework\Domain\Product;

class UpdatePriceAndStockAction extends PostBack implements Action
{
    /**
     * @var string
     */
    public $input;

    /**
     * @var ProductUpdater
     */
    private $productUpdater;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $cwProductId = null;

    /**
     * @var SpreadRetriever
     */
    private $spreadRetriever;

    /**
     * @var SpreadCalculatorImpl
     */
    private $spreadCalculator;

    /**
     * @var ExternalProductRetriever
     */
    private $product;

    /**
     * UpdatePriceAndStockAction constructor.
     * @param ProductUpdater $productUpdater
     * @param SpreadRetriever $spreadRetriever
     * @param ExternalProductRetriever $product
     * @param SpreadCalculator $spreadCalculator
     * @param Client $client
     */
    public function __construct(ProductUpdater $productUpdater, SpreadRetriever $spreadRetriever,
                                ExternalProductRetriever $product, SpreadCalculator $spreadCalculator, Client $client)
    {
        $this->productUpdater = $productUpdater;
        $this->spreadRetriever = $spreadRetriever;
        $this->spreadCalculator = $spreadCalculator;
        $this->product = $product;
        $this->client = $client;
    }

    /**
     * @return Product
     * @throws ProductIdIsSetException
     */
    public function process()
    {
        $this->productIdIsSet();
        $this->isEmptyRequest();

        $productId = $this->client->receiveUpdatedProductId();
        $product = $this->getProductById($productId);

        $mapper = new ProductMapper($product);
        $mappedProduct = $mapper->map();
        
        $spreadParams = $this->spreadRetriever->getSpreadParams();
        $priceWithSpread = $this->spreadCalculator->calculateSpread($spreadParams, $mappedProduct->getPrice());

        return $this->productUpdater->updateProduct($mappedProduct, $priceWithSpread);
    }

    /**
     * @throws ProductIdIsSetException
     */
    private function productIdIsSet()
    {
        if ($this->cwProductId) {
            throw new ProductIdIsSetException;
        }
    }

    /**
     * @param $productId
     * @return ExternalProduct
     */
    private function getProductById($productId)
    {
        try {
            $product = $this->product->getProductById($productId);
            return $product;
        } catch (ResourceError $e) {
            die('Received product id: ' . $this->cwProductId . ' Error: ' . $e->getMessage());
        }
    }
}