<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 08/06/16
 * Time: 15:58
 */

namespace CodesWholesaleFramework\Importer;

use CodesWholesaleFramework\Domain\Product;
use CodesWholesaleFramework\Domain\SpreadData;
use CodesWholesaleFramework\Exceptions\CatalogSynchronizerException;
use CodesWholesaleFramework\Exceptions\LocationNotFoundException;
use CodesWholesaleFramework\Postback\UpdatePriceAndStock\SpreadCalculatorImpl;
use CodesWholesaleFramework\Utils\UrlHeader;

class CatalogImporter
{
    const NO_IMAGE_SANDBOX_URL = 'https://sandbox.codeswholesale.com/assets/images/no-image.jpg';
    const NO_IMAGE_LIVE_URL = 'https://app.codeswholesale.com/assets/images/no-image.jpg';
    const NO_IMAGE_API_URL = 'https://api.codeswholesale.com/assets/images/no-image.jpg';
    /**
     * @var Product[]
     */
    private $productsArray;

    /**
     * @var ProductCreator
     */
    protected $productCreator;

    /**
     * @var string
     */
    private $storeName;

    /**
     * @var InternalCatalogExporter
     */
    private $internalCatalogExporter;

    /**
     * @var array
     */
    private $mergedCatalog;

    /**
     * @var UrlHeader
     */
    private $urlHeader;

    /**
     * @var SpreadCalculatorImpl
     */
    private $spreadCalculator;

    /**
     * @var SpreadData
     */
    private $spreadData;

    /**
     * @var int
     */
    private $numberOfUpdatedProducts;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * CatalogImporter constructor.
     * @param ProductCreator $productCreator
     * @param InternalCatalogExporter $catalogExporter
     * @param array $mappedProducts
     * @param $mergedCatalog
     * @param $storeName
     * @param SpreadData $spreadData
     * @param Logger $logger
     */
    public function __construct(ProductCreator $productCreator, InternalCatalogExporter $catalogExporter,
                                array $mappedProducts, $mergedCatalog, $storeName, SpreadData $spreadData, Logger $logger)
    {
        $this->productsArray = $mappedProducts;
        $this->productCreator = $productCreator;
        $this->mergedCatalog = $mergedCatalog;
        $this->storeName = $storeName;
        $this->internalCatalogExporter = $catalogExporter;
        $this->urlHeader = new UrlHeader();
        $this->spreadCalculator = new SpreadCalculatorImpl();
        $this->spreadData = $spreadData;
        $this->numberOfUpdatedProducts = 0;
        $this->logger = $logger;
    }

    public function synchronize()
    {
        try {

            if (empty($this->mergedCatalog)) {
                $this->createNewProducts();
            } else {
                $this->createNotMergedProducts();
            }

        } catch (CatalogSynchronizerException $e) {
             $this->logger->addMessage($e->getMessage());
        }
    }

    private function createNewProducts()
    {
        foreach ($this->productsArray as $product) {
            $this->createProduct($product);
            $this->numberOfUpdatedProducts++;
        }
    }

    private function createNotMergedProducts()
    {
        $mergedProductMap = array();

        foreach ($this->mergedCatalog as $mergedProduct) {
            $mergedProductMap[$mergedProduct['cw_product_id']] = true;
        }

        foreach ($this->productsArray as $product) {
            if (array_key_exists($product->getId(), $mergedProductMap) == false) {
                $this->createProduct($product);
                $this->numberOfUpdatedProducts++;
            }
        }
    }

    /**
     * @param Product $product
     * @throws \CodesWholesaleFramework\Exceptions\InvalidSpreadTypeException
     */
    private function createProduct(Product $product)
    {
        $price = $this->spreadCalculator->calculateSpread($this->spreadData, $product->getPrice());
        $properImageUrl = $this->assignProperImageUrl($product->getImageUrl());
        $productId = $this->productCreator->createNewProduct($product, $properImageUrl, $price);
        $this->internalCatalogExporter->export($product, $this->storeName, $productId);
    }

    /**
     * @param $imageUrl
     * @return string
     * @throws LocationNotFoundException
     */
    private function assignProperImageUrl($imageUrl)
    {
        if ($imageUrl == self::NO_IMAGE_SANDBOX_URL || $imageUrl == self::NO_IMAGE_API_URL) {
            $properImageUrl = self::NO_IMAGE_LIVE_URL;
        } else {
            $properImageUrl = $this->urlHeader->getTargetUrl($imageUrl);
        }
        return $properImageUrl;
    }

}