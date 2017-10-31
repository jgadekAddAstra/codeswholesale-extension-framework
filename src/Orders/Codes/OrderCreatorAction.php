<?php
namespace CodesWholesaleFramework\Orders\Codes;

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

use CodesWholesale\Resource\ResourceError;
use CodesWholesaleFramework\Action;
use CodesWholesaleFramework\Connection\Client;
use CodesWholesaleFramework\Domain\Order;
use CodesWholesaleFramework\Errors\ErrorHandler;
use CodesWholesaleFramework\Exceptions\EmptyOrderDataException;
use CodesWholesaleFramework\Mappers\ExternalProduct;
use CodesWholesaleFramework\Postback\ReceivePreOrders\EventDispatcher;
use CodesWholesaleFramework\Postback\Retriever\ItemRetriever;

class OrderCreatorAction implements Action
{
    /**
     * @var StatusChange
     */
    private $statusChange;
    /**
     * @var DataBaseExporter
     */
    private $exportToDataBase;
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;
    /**
     * @var PurchaseCode
     */
    private $purchaseCode;
    /**
     * @var ItemRetriever
     */
    private $itemRetriever;

    /**
     * @var OrderValidation
     */
    private $orderValidation;
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ExternalProduct
     */
    private $externalProduct;

    /**
     * @var Order
     */
    private $order;

    /**
     * @var ErrorHandler
     */
    private $errorHandler;

    /**
     * OrderCreatorAction constructor.
     * @param StatusChange $statusChange
     * @param DataBaseExporter $exportOrderToDataBase
     * @param EventDispatcher $eventDispatcher
     * @param Purchase $purchase
     * @param ItemRetriever $itemRetriever
     * @param OrderValidation $orderValidation
     * @param Client $client
     * @param ExternalProduct $product
     * @param Order $order
     * @param ErrorHandler $errorHandler
     */
    public function __construct(StatusChange $statusChange, DataBaseExporter $exportOrderToDataBase, EventDispatcher $eventDispatcher,
                                Purchase $purchase, ItemRetriever $itemRetriever, OrderValidation $orderValidation, Client $client,
                                ExternalProduct $product, Order $order, ErrorHandler $errorHandler)
    {
        $this->statusChange = $statusChange;
        $this->exportToDataBase = $exportOrderToDataBase;
        $this->eventDispatcher = $eventDispatcher;
        $this->purchaseCode = $purchase;
        $this->itemRetriever = $itemRetriever;
        $this->orderValidation = $orderValidation;
        $this->client = $client;
        $this->externalProduct = $product;
        $this->order = $order;
        $this->errorHandler = $errorHandler;
    }
    
    public function process()
    {
        try {

            $this->statusChange->checkStatus($this->order);
            $this->proceedPurchase();

            $this->eventDispatcher->dispatchEvent($this->order);

        } catch (ResourceError $e) {

            $this->errorHandler->handleError($e);
            
        }
    }

    private function proceedPurchase()
    {
        foreach ($this->order->getOrderedItems() as $itemKey => $item) {

            $internalProduct = $this->itemRetriever->retrieveItem($this->order->getId());
            $externalProduct = $this->externalProduct->get($internalProduct->getExternalItemId());

            $orderedCodes = $this->purchaseCode->purchase($externalProduct,  $internalProduct->getQuantity());

            $this->exportToDataBase->export($item, $orderedCodes, $itemKey);
        }

        $this->validatePurchase();
    }

    /**
     * @throws EmptyOrderDataException
     */
    private function validatePurchase()
    {
        $validatedOrder = $this->orderValidation->validatePurchase($this->order, $this->client);
        $this->isNotNull($validatedOrder);
    }

    /**
     * @param Order $order
     * @throws EmptyOrderDataException
     */
    protected function isNotNull(Order $order)
    {
        if(empty($order)){
            throw new EmptyOrderDataException();
        }
    }
}