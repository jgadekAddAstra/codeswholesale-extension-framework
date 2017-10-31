<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 08/06/16
 * Time: 16:46
 */

namespace CodesWholesaleFramework\Importer;

use CodesWholesaleFramework\Domain\Product;

interface ProductCreator
{
    /**
     * @param Product $product
     * @param $properImageUrl
     * @param $price
     * @return mixed
     */
    public function createNewProduct(Product $product, $properImageUrl, $price);
}