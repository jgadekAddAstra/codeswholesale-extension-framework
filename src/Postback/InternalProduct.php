<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 21/06/16
 * Time: 10:23
 */

namespace CodesWholesaleFramework\Postback;


interface InternalProduct
{
    /**
     * @return int
     */
    public function getQuantity();
    
    /**
     * @return string
     */
    public function getExternalItemId();

    /**
     * @return string
     */
    public function getLinks();

    /**
     * @return int
     */
    public function getNumberOfPreOrders();
}