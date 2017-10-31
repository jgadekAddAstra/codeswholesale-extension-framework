<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 09/06/16
 * Time: 13:30
 */

namespace CodesWholesaleFramework\Importer\Currencies;

use CodesWholesaleFramework\Domain\Currency;

class CurrencyImporter
{
    const CURRENCY_RATES_ENDPOINT = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
    const DEFAULT_CURRENCY = "EUR";

    /**
     * @var Currency[]
     */
    private $currencyInformation;

    /**
     * CurrencyImporter constructor.
     */
    public function __construct()
    {
        $this->currencyInformation = $this->import();
    }

    /**
     * @param $currency
     * @return float
     */
    public function getRateByCurrencyName($currency)
    {
        if ($currency != self::DEFAULT_CURRENCY) {
            return $this->getRate($this->currencyInformation, $currency);
        }
        return 1;
    }

    /**
     * @return Currency
     */
    protected function import()
    {
        $currencies = simplexml_load_file(self::CURRENCY_RATES_ENDPOINT);
        $mapper = new ImportedCurrencyMapper($currencies);
        $currencyMap = $mapper->map();
        return $currencyMap;
    }

    /**
     * @param $currencies
     * @param $currencyName
     * @return float
     */
    private function getRate($currencies, $currencyName) {
        foreach ($currencies as $currency) {
            if ($currencyName == $currency->getName()) {
                return floatval($currency->getRate());
            }
        }
        return 1;
    }
}