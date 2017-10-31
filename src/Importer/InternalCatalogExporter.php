<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 08/06/16
 * Time: 16:56
 */

namespace CodesWholesaleFramework\Importer;

use CodesWholesaleFramework\Domain\Product;

interface InternalCatalogExporter
{
    public function export(Product $product, $storeName, $productId);
}