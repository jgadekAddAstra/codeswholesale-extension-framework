<?php

namespace CodesWholesaleFramework\Domain;
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 06/06/16
 * Time: 16:57
 */
class SpreadData
{
    /**
     * @var int
     */
    private $spreadType;

    /**
     * @var float
     */
    private $spreadValue;

    /**
     * SpreadData constructor.
     * @param int $spreadType
     * @param float $spreadValue
     */
    public function __construct(int $spreadType, float $spreadValue)
    {
        $this->spreadType = $spreadType;
        $this->spreadValue = $spreadValue;
    }

    /**
     * @return int
     */
    public function getSpreadType()
    {
        return $this->spreadType;
    }

    /**
     * @return float
     */
    public function getSpreadValue()
    {
        return $this->spreadValue;
    }


}