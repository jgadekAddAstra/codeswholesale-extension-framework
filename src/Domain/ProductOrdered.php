<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 22/06/16
 * Time: 14:33
 */

namespace CodesWholesaleFramework\Domain;

interface ProductOrdered
{
    /**
     * @return string
     */
    public function getProductOrderedId();

    /**
     * @return string
     */
    public function getOrderId();
}