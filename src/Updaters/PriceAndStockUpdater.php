<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 06/06/16
 * Time: 16:47
 */

namespace CodesWholesaleFramework\Updaters;

interface PriceAndStockUpdater
{
    /**
     * @param string $cwProductId
     * @param int $quantity
     * @param float $priceSpread
     * @param string $storeName
     */
    public function updateProduct($cwProductId, $quantity, $priceSpread, $storeName);
}