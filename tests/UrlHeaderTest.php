<?php

use CodesWholesaleFramework\Exceptions\InvalidUrlException;
use CodesWholesaleFramework\Exceptions\LocationNotFoundException;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 09/06/16
 * Time: 16:52
 */
class UrlHeaderTest extends TestCase
{
    const TARGET_URL = "https://app.codeswholesale.com/api/products/d2774d3e-b0fc-4080-8fb7-889d60d2ddcf/image?format=SMALL&ext=jpg";
    const LOCATION = "https://s3-eu-west-1.amazonaws.com/cw-pub/products/d2774d3e-b0fc-4080-8fb7-889d60d2ddcf/min.jpg";
    const INVALID_URL = "test@12";

    /**
     * @var \CodesWholesaleFramework\Utils\UrlHeader
     */
    private $urlHeader;

    public function setUp()
    {
        parent::setUp();
        $this->urlHeader = new \CodesWholesaleFramework\Utils\UrlHeader();
    }

    public function testShouldReturnLocation() {
        $location = $this->urlHeader->getTargetUrl(self::TARGET_URL);
        $this->assertEquals(self::LOCATION, $location);
    }

    public function testShouldThrowInvalidUrlException() {
        $this->setExpectedException(InvalidUrlException::class);
        $this->urlHeader->getTargetUrl(self::INVALID_URL);
    }

    public function testShouldThrowLocationNotFoundException() {
        $this->setExpectedException(LocationNotFoundException::class);
        $this->urlHeader->getTargetUrl(self::LOCATION);
    }
}