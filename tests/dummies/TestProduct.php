<?php

use CodesWholesaleFramework\Mappers\ExternalProduct;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 17/06/16
 * Time: 10:41
 */
class TestProduct implements ExternalProduct
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $stock;

    /**
     * @var string
     */
    private $platform;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * TestProduct constructor.
     * @param $id
     * @param string $name
     * @param float $price
     * @param string $stock
     * @param string $platform
     * @param string $imageUrl
     */
    public function __construct($id, $name, $price, $stock, $platform, $imageUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->platform = $platform;
        $this->imageUrl = $imageUrl;
    }

    public function get($href, array $options = array())
    {
        // TODO: Implement get() method.
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getLowestPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getStockQuantity()
    {
        return $this->stock;
    }

    /**
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param $imageSize
     * @return string
     */
    public function getImageUrl($imageSize)
    {
        return $this->imageUrl;
    }
}