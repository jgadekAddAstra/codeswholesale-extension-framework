<?php

namespace CodesWholesaleFramework\Postback\ReceivePreOrders;

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
use CodesWholesaleFramework\Connection\Client;
use CodesWholesaleFramework\Exceptions\ReceivePreOrderException;
use CodesWholesaleFramework\Postback\Extractor\NewKeysExtractor;
use CodesWholesaleFramework\Postback\InternalProduct;
use CodesWholesaleFramework\Postback\PostBack;
use CodesWholesaleFramework\Postback\Retriever\ItemRetriever;

class ReceivePreOrdersAction extends PostBack implements Action
{
    /**
     * @var string
     */
    public $input;

    /**
     * @var ItemRetriever
     */
    private $itemRetriever;

    /**
     * @var NewKeysExtractorImpl
     */
    private $newKeysExtractor;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @var ExternalOrder
     */
    private $externalOrder;

    /**
     * @var Client
     */
    private $client;

    /**
     * ReceivePreOrdersAction constructor.
     * @param ItemRetriever $itemRetriever
     * @param EventDispatcher $eventDispatcher
     * @param NewKeysExtractor $newKeysExtractor
     * @param ExternalOrder $externalOrder
     * @param Client $client
     */
    public function __construct(ItemRetriever $itemRetriever, EventDispatcher $eventDispatcher, 
                                NewKeysExtractor $newKeysExtractor, ExternalOrder $externalOrder, Client $client)
    {
        $this->itemRetriever = $itemRetriever;
        $this->eventDispatcher = $eventDispatcher;
        $this->newKeysExtractor = $newKeysExtractor;
        $this->externalOrder = $externalOrder;
        $this->client = $client;
    }

    public function process()
    {
        try {

            $this->isEmptyRequest();

            $productOrdered = $this->client->receiveProductOrdered();

            $codeList = $this->externalOrder->getCodes($productOrdered);

            $product = $this->retrieveExistingProduct($productOrdered);
            $newKeys = $this->newKeysExtractor->extract($product, $codeList);

            $this->eventDispatcher->dispatchEvent($newKeys);

        } catch (ReceivePreOrderException $e) {

            die(self::ERROR_MESSAGE . $e->getMessage());
        }
    }

    /**
     * @param ProductOrdered $productOrdered
     * @return InternalProduct
     */
    private function retrieveExistingProduct(ProductOrdered $productOrdered) {
        $orderId = $productOrdered->getOrderId();
        return $this->itemRetriever->retrieveItem($orderId);
    }
}