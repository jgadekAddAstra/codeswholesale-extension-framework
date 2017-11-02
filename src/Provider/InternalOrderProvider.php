<?php

namespace CodesWholesale\Provider;

use CodesWholesale\Model\InternalOrder;

/**
 * Class InternalOrderProvider
 */
class InternalOrderProvider
{
    /**
     * @param int $orderId
     *
     * @return InternalOrder
     */
    public function generateById(int $orderId): InternalOrder
    {
        return new InternalOrder($orderId);
    }
}