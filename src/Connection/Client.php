<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 20/06/16
 * Time: 11:37
 */

namespace CodesWholesaleFramework\Connection;

use \CodesWholesaleFramework\Postback\ReceivePreOrders\ProductOrdered;

interface Client
{
    /**
     * @return ProductOrdered
     */
    public function receiveProductOrdered();

    /**
     * @return string
     */
    public function receiveUpdatedProductId();
}