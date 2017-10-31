<?php

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 10/06/16
 * Time: 15:20
 */
class TestSpreadRetriever implements \CodesWholesaleFramework\Postback\Retriever\SpreadRetriever
{
    private $spreadType;

    private $spreadValue;

    /**
     * TestSpreadRetriever constructor.
     * @param $spreadType
     * @param $spreadValue
     */
    public function __construct($spreadType, $spreadValue)
    {
        $this->spreadType = $spreadType;
        $this->spreadValue = $spreadValue;
    }


    public function getSpreadParams()
    {
       return new \CodesWholesaleFramework\Domain\SpreadData($this->spreadType, $this->spreadValue);
    }
}