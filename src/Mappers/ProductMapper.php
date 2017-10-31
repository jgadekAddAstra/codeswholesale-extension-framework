<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 17/06/16
 * Time: 11:52
 */

namespace CodesWholesaleFramework\Mappers;
use CodesWholesaleFramework\Domain\Product;

class ProductMapper implements Mapper
{
    const IMAGE_SIZE = 'MEDIUM';
    private $product;

    /**
     * ProductMapper constructor.
     * @param $product
     */
    public function __construct(ExternalProduct $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     * @throws \CodesWholesale\Exceptions\NoImagesFoundException
     */
    public function map()
    {
        return new Product(
            $this->product->getProductId(),
            $this->product->getName(),
            $this->product->getLowestPrice(),
            $this->product->getStockQuantity(),
            $this->product->getPlatform(),
            $this->product->getImageUrl(self::IMAGE_SIZE)
        );
    }
}