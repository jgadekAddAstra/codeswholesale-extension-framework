<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 01/06/16
 * Time: 11:27
 */

namespace CodesWholesaleFramework\Exceptions;

class LocationNotFoundException extends \Exception
{
    public $message = "Location not Found";
}