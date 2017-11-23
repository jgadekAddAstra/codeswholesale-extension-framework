<?php

namespace CodesWholesaleFramework\Model;

use CodesWholesale\Resource\Product;

/**
 * Class ExternalProduct
 */
class ExternalProduct
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return ExternalProduct
     */
    public function setProduct(Product $product): ExternalProduct
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return ExternalProduct
     */
    public function setDescription(string $description): ExternalProduct
    {
        $this->description = $description;

        return $this;
    }
}