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
use CodesWholesaleFramework\Domain\Product;

class UpdateOrderWithPreOrdersAction implements Action
{
    /**
     * @var UpdateOrderWithPreOrders
     */
    private $updateOrderWithPreOrders;

    /**
     * @var array
     */
    private $newKeys;

    /**
     * UpdateOrderWithPreOrdersAction constructor.
     * @param UpdateOrderWithPreOrders $updateOrderWithPreOrders
     */
    public function __construct(UpdateOrderWithPreOrders $updateOrderWithPreOrders){
        $this->updateOrderWithPreOrders = $updateOrderWithPreOrders;
    }

    /**
     * @return Product
     */
    public function process(){
        $textComment = $this->prepareMessage($this->newKeys);
        return $this->updateOrderWithPreOrders->update($this->newKeys, $textComment);
    }

    /**
     * @param array $newKeys
     * @return string
     */
    protected function prepareMessage(array $newKeys) {
        return 'PreOrder Codes to send: ' . ($newKeys['total'] - $newKeys['preOrdersLeft'] . '/' . $newKeys['total']);
    }

    /**
     * @param array $newKeys
     */
    public function setKeys($newKeys){
        $this->newKeys = $newKeys;
    }
}