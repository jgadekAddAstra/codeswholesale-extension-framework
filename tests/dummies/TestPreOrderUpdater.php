<?php

use \CodesWholesaleFramework\Postback\ReceivePreOrders\UpdateOrderWithPreOrders;
use \CodesWholesaleFramework\Domain\Product;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 20/06/16
 * Time: 11:01
 */
class TestPreOrderUpdater implements UpdateOrderWithPreOrders
{
    /**
     * @param $newKeys
     * @param $textComment
     * @return Product
     */
    public function update($newKeys, $textComment)
    {
       return new Product();
    }
}