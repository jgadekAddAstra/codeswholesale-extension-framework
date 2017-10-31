<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 16/06/16
 * Time: 15:27
 */

namespace CodesWholesaleFramework\Connection;

interface Connection
{
    /**
     * @param array $options
     * @return Client
     */
    public static function getConnection(array $options);
}