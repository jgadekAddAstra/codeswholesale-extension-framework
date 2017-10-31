<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 24/06/16
 * Time: 15:56
 */

namespace CodesWholesaleFramework\Errors;


interface ErrorHandler
{
    /**
     * @param $e
     */
    public function handleError($e);
}