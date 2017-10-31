<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 08/06/16
 * Time: 16:48
 */

namespace CodesWholesaleFramework\Domain;

class Product
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var float
     */
    private $price;

    /**
     * @var int
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
     * Product constructor.
     * @param $id
     * @param $title
     * @param $price
     * @param $stock
     * @param $platform
     * @param $imageUrl
     */
    public function __construct($id, $title, $price, $stock, $platform, $imageUrl)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->stock = $stock;
        $this->platform = $platform;
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getStock()
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
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }
}