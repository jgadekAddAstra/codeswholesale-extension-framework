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

use CodesWholesaleFramework\Domain\PurchasedCodes;
use CodesWholesaleFramework\Mappers\ExternalProduct;
use CodesWholesaleFramework\Domain\ExternalOrder;
use CodesWholesaleFramework\Utils\Links;

class PurchaseCode implements Purchase {

    /**
     * @var ExternalOrder
     */
    private $externalOrder;

    /**
     * PurchaseCode constructor.
     * @param ExternalOrder $externalOrder
     */
    public function __construct(ExternalOrder $externalOrder)
    {
        $this->externalOrder = $externalOrder;
    }

    /**
     * @param ExternalProduct $externalProduct
     * @param int $qty
     * @return PurchasedCodes
     */
    public function purchase(ExternalProduct $externalProduct, $qty) {

        $codes = $this->externalOrder->createBatchOrder($externalProduct, ['quantity' => $qty]);
        $orderId = $codes->getOrderId();

        $linksUtil = new Links($codes);

        $links = $linksUtil->getLinksFromCodeList();
        $numberOfPreOrders = $linksUtil->getNumberOfPreOrders();
        
        return new PurchasedCodes($orderId, $links, $numberOfPreOrders, date('c'));
    }
}