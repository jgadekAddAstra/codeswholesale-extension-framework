<?php

namespace CodesWholesaleFramework\Provider;

use CodesWholesaleFramework\Model\InternalOrder;

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