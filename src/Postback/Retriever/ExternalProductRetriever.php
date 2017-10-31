<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 16/06/16
 * Time: 15:24
 */

namespace CodesWholesaleFramework\Postback\Retriever;

interface ExternalProductRetriever
{
    /**
     * @param $href
     * @param array $options
     * @return \CodesWholesale\Resource\Product
     */
    public function getProductById($href, array $options = array());
}