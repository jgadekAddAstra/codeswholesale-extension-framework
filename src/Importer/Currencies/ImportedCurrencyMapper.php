<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 09/06/16
 * Time: 13:48
 */

namespace CodesWholesaleFramework\Importer\Currencies;

use CodesWholesaleFramework\Domain\Currency;
use CodesWholesaleFramework\Mapper;

class ImportedCurrencyMapper implements Mapper
{
    private $currencies;

    private $currenciesMap = array();

    /**
     * ImportedCurrencyMapper constructor.
     * @param $currencies
     */
    public function __construct($currencies)
    {
        $this->currencies = $currencies->Cube->Cube->children();
    }

    /**
     * @return array
     */
    public function map() {

        $i = 0;

        foreach ($this->currencies as $currency){

            $this->currenciesMap[$i] = new Currency(
                (string) $currency['currency'],
                (float) $currency['rate']
            );

            $i++;
        }

        return $this->currenciesMap;
    }
}