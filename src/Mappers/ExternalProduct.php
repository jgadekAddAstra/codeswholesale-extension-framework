<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 17/06/16
 * Time: 13:02
 */

namespace CodesWholesaleFramework\Mappers;


interface ExternalProduct
{
    /**
     * @param $href
     * @param array $options
     * @return ExternalProduct
     */
    public function get($href, array $options = array());

    /**
     * @return string
     */
    public function getProductId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return float
     */
    public function getLowestPrice();

    /**
     * @return int
     */
    public function getStockQuantity();

    /**
     * @return string
     */
    public function getPlatform();

    /**
     * @param $imageSize
     * @return mixed
     */
    public function getImageUrl($imageSize);
}