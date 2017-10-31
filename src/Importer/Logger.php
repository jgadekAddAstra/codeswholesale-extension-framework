<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 09/06/16
 * Time: 10:27
 */

namespace CodesWholesaleFramework\Importer;

interface Logger
{
    /**
     * @param $message
     * @return void
     */
    public function addMessage($message);
}