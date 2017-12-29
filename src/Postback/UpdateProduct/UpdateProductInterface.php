<?php

namespace CodesWholesaleFramework\Postback\UpdatePriceAndStock\Utils;

/**
 * Interface UpdateProductInterface
 */
interface UpdateProductInterface
{
    public function updateProduct($cwProductId, $quantity , $priceSpread);

    public function hideProduct($cwProductId);

    public static function updateProductsPrice();
}