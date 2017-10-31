<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 21/06/16
 * Time: 10:39
 */

namespace CodesWholesaleFramework\Postback;

interface ExternalCodeList
{
    /**
     * @return array
     */
    public function getCodes();
    /**
     * @return string
     */
    public function getOrderId();
}