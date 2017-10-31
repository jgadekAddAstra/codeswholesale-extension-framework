<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 20/06/16
 * Time: 14:04
 */

namespace CodesWholesaleFramework\Domain;
use CodesWholesaleFramework\Mappers\ExternalProduct;
use CodesWholesaleFramework\Postback\ExternalCodeList;

interface ExternalOrder
{
    /**
     * @param ProductOrdered $productOrdered
     * @return ExternalCodeList
     */
    public function getCodes(ProductOrdered $productOrdered);

    /**
     * @param ExternalProduct $product
     * @param array $qty
     * @return ExternalCodeList
     */
    public function createBatchOrder(ExternalProduct $product, array $qty);
}