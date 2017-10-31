<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 12/05/16
 * Time: 13:25
 */

namespace CodesWholesaleFramework\Updaters;

use CodesWholesale\Resource\ProductList;
use CodesWholesaleFramework\Domain\SpreadData;
use CodesWholesaleFramework\Exceptions\ForceUpdateException;
use CodesWholesaleFramework\Postback\UpdatePriceAndStock\SpreadCalculator;

/**
 * Class ForceUpdater
 * @package CodesWholesaleFramework\Updaters
 */
class ForceUpdater
{
    /**
     * @var ProductList
     */
    private $cwPriceList;

    /**
     * @var SpreadData
     */
    private $spreadData;

    /**
     * @var SpreadCalculator
     */
    private $spreadCalculator;

    /**
     * @var array
     */
    private $productList;

    /**
     * @var PriceAndStockUpdater
     */
    private $priceAndStockUpdater;

    /**
     * ForceUpdater constructor.
     * @param ProductList $cwPriceList
     * @param array $productList
     * @param PriceAndStockUpdater $priceAndStockUpdater
     * @param SpreadData $spreadData
     * @param SpreadCalculator $spreadCalculator
     * @param $storeName
     */
    public function __construct(ProductList $cwPriceList, array $productList, PriceAndStockUpdater $priceAndStockUpdater,
                                SpreadData $spreadData, SpreadCalculator $spreadCalculator, $storeName)
    {
        $this->cwPriceList = $cwPriceList;
        $this->productList = $productList;
        $this->priceAndStockUpdater = $priceAndStockUpdater;
        $this->spreadData = $spreadData;
        $this->spreadCalculator = $spreadCalculator;
        $this->storeName = $storeName;
    }

    /**
     * @return array
     */
    public function forceUpdate()
    {
        $updatedProducts = 0;

        try {

            $cwPriceListMap = $this->mapCwPriceList();

            foreach ($this->productList as $product) {

                $productData = $cwPriceListMap[$product->getCwProductId()];

                $priceSpread = $this->spreadCalculator->calculateSpread(
                    $this->spreadData,
                    $productData['price']
                );

                $this->priceAndStockUpdater->updateProduct(
                    $product->getCwProductId(),
                    $productData['stock'],
                    $priceSpread,
                    $this->storeName
                );

                $updatedProducts++;
            }

            return ['status' => 200, 'updatedProducts' => intval($updatedProducts)];

        } catch (ForceUpdateException $e) {

            return ['status' => 500, 'message' => $e->getMessage()];
        }
    }

    /**
     * @return array
     */
    private function mapCwPriceList()
    {
        $cwPriceListMap = array();

        foreach ($this->cwPriceList as $cwProduct) {
            $cwPriceListMap[$cwProduct->getProductId()] = array('stock' => $cwProduct->getStockQuantity(),
                'price' => $cwProduct->getLowestPrice());
        }
        return $cwPriceListMap;
    }
}