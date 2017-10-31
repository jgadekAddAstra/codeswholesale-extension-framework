<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 09/06/16
 * Time: 13:55
 */

namespace CodesWholesaleFramework\Domain;

class Currency
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $rate;

    /**
     * Currency constructor.
     * @param string $name
     * @param float $rate
     */
    public function __construct($name, $rate)
    {
        $this->name = $name;
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }
}