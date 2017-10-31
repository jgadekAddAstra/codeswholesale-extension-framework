<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 23/06/16
 * Time: 10:45
 */

namespace CodesWholesaleFramework\Domain;


class PurchasedCodes
{
    /**
     * @var string
     */
    private $orderId;

    /**
     * @var string
     */
    private $links;

    /**
     * @var int
     */
    private $numberOfPreOrders;

    /**
     * @var string
     */
    private $orderDate;

    /**
     * PurchasedCodes constructor.
     * @param string $orderId
     * @param string $links
     * @param int $numberOfPreOrders
     * @param string $orderDate
     */
    public function __construct($orderId, $links, $numberOfPreOrders, $orderDate)
    {
        $this->orderId = $orderId;
        $this->links = $links;
        $this->numberOfPreOrders = $numberOfPreOrders;
        $this->orderDate = $orderDate;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return int
     */
    public function getNumberOfPreOrders()
    {
        return $this->numberOfPreOrders;
    }

    /**
     * @return string
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }
}