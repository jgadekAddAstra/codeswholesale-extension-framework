<?php
use CodesWholesaleFramework\Postback\UpdatePriceAndStock\ProductUpdater;
use CodesWholesaleFramework\Domain\Product;
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 10/06/16
 * Time: 15:17
 */
class TestProductUpdater implements ProductUpdater
{
    /**
     * @param \CodesWholesaleFramework\Domain\Product $product
     * @param $priceWithSpread
     * @return \CodesWholesaleFramework\Domain\Product
     */
    public function updateProduct(Product $product, $priceWithSpread) {
        return new \CodesWholesaleFramework\Domain\Product(
            $product->getId(),
            $product->getTitle(),
            $priceWithSpread,
            $product->getStock(),
            $product->getPlatform(),
            $product->getImageUrl(),
            null
        );
    }
}