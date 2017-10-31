<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 23/06/16
 * Time: 17:10
 */

namespace CodesWholesaleFramework\Domain;


class Order
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $orderedItems;

    /**
     * @var array
     */
    private $storeOrderData;

    /**
     * Order constructor.
     * @param $id
     * @param $orderedItems
     * @param $storeOrderData
     */
    public function __construct($id, $orderedItems, $storeOrderData)
    {
        $this->id = $id;
        $this->orderedItems = $orderedItems;
        $this->storeOrderData = $storeOrderData;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getOrderedItems()
    {
        return $this->orderedItems;
    }

    /**
     * @return array
     */
    public function getStoreOrderData()
    {
        return $this->storeOrderData;
    }
}