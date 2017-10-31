<?php

require_once __DIR__ . '/TestProduct.php';

use CodesWholesaleFramework\Postback\Retriever\ExternalProductRetriever;
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 17/06/16
 * Time: 10:40
 */
class TestProductRetriever implements ExternalProductRetriever
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
     * TestProductRetriever constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $stock
     * @param $platform
     * @param $imageUrl
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

    /**
     * @param $href
     * @param array $options
     * @return TestProduct
     */
    public function getProductById($href, array $options = array())
    {
       return new TestProduct($this->id, $this->name, $this->price, $this->stock, $this->platform, $this->imageUrl);
    }
}