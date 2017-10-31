<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 16/06/16
 * Time: 11:00
 */

use CodesWholesaleFramework\Connection\Client;

class TestConnection implements Client
{
    public function receiveProductOrdered()
    {
        //
    }

    public function receiveUpdatedProductId()
    {
        return 'ffe2274d-5469-4b0f-b57b-f8d21b09c24c';
    }

}