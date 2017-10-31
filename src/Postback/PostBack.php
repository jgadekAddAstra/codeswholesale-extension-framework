<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 20/06/16
 * Time: 13:33
 */

namespace CodesWholesaleFramework\Postback;

class PostBack
{
    const ERROR_MESSAGE = "We found error. Probably this is the result of sending test POSTBACK. If your response status is: 200 OK
             it means that you are successfully connected. Error: ";
    
    /**
     * @var string
     */
    protected $input = 'php://input';

    protected function isEmptyRequest() {

        $request = file_get_contents($this->input);

        if (empty($request))
            die("No request data");
    }
}