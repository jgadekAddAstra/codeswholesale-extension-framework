<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 21/06/16
 * Time: 10:55
 */

namespace CodesWholesaleFramework\Postback;


interface ImageWriter
{
    /**
     * @param $code
     * @param string $directory
     * @return string $directory
     */
    public function write($code, $directory);
}