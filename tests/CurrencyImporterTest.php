<?php

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 09/06/16
 * Time: 14:13
 */

use CodesWholesaleFramework\Importer\Currencies\CurrencyImporter;
use CodesWholesaleFramework\Importer\Currencies\CurrencyCode;

class CurrencyImporterTest extends TestCase
{
    /**
     * @var CurrencyImporter
     */
    private $importer;

    public function setUp()
    {
        parent::setUp();
        $this->importer = new CurrencyImporter();
    }

    public function testShouldReturnCurrencyRate() {

        $currencyRate = $this->importer->getRateByCurrencyName(CurrencyCode::USD);

        $this->assertNotNull($currencyRate);
        $this->assertGreaterThan(0, $currencyRate);
    }

    public function testShouldRecognizeDefaultValue() {

        $currencyRate = $this->importer->getRateByCurrencyName(CurrencyCode::EUR);

        $this->assertEquals(1, $currencyRate);
    }
}