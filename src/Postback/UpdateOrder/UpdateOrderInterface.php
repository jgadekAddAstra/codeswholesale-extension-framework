<?php

namespace CodesWholesaleFramework\Postback\UpdateOrder;

/**
 * Interface UpdateOrderInterface
 */
interface UpdateOrderInterface
{
    /**
     * @param string $orderId
     *
     * @return mixed
     */
    public function preOrderAssigned(string $orderId);
}