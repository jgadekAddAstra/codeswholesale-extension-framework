<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 22/06/16
 * Time: 16:24
 */

namespace CodesWholesaleFramework\Orders\Codes;

use CodesWholesaleFramework\Domain\PurchasedCodes;
use CodesWholesaleFramework\Mappers\ExternalProduct;

interface Purchase
{
    /**
     * @param ExternalProduct $externalProduct
     * @param $qty
     * @return PurchasedCodes
     */
    public function purchase(ExternalProduct $externalProduct, $qty);
}