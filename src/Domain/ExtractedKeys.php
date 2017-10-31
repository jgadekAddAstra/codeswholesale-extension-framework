<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 21/06/16
 * Time: 13:29
 */

namespace CodesWholesaleFramework\Domain;
use CodesWholesaleFramework\Postback\InternalProduct;

class ExtractedKeys
{
    /**
     * @var InternalProduct
     */
    private $internalProduct;

    /**
     * @var array
     */
    private $newCodes;

    /**
     * @var int
     */
    private $preOrdersLeft;

    /**
     * @var int
     */
    private $totalNumberOfPreOrders;

    /**
     * @var array
     */
    private $linksToAdd;

    /**
     * @var array
     */
    private $links;

    /**
     * @var array
     */
    private $attachments;

    /**
     * ExtractedKeys constructor.
     * @param InternalProduct $internalProduct
     * @param array $newCodes
     * @param int $preOrdersLeft
     * @param int $totalNumberOfPreOrders
     * @param array $linksToAdd
     * @param array $links
     * @param array $attachments
     */
    public function __construct(InternalProduct $internalProduct, array $newCodes, $preOrdersLeft,
                                $totalNumberOfPreOrders, array $linksToAdd, array $links, array $attachments)
    {
        $this->internalProduct = $internalProduct;
        $this->newCodes = $newCodes;
        $this->preOrdersLeft = $preOrdersLeft;
        $this->totalNumberOfPreOrders = $totalNumberOfPreOrders;
        $this->linksToAdd = $linksToAdd;
        $this->links = $links;
        $this->attachments = $attachments;
    }

    /**
     * @return InternalProduct
     */
    public function getInternalProduct()
    {
        return $this->internalProduct;
    }

    /**
     * @return array
     */
    public function getNewCodes()
    {
        return $this->newCodes;
    }

    /**
     * @return int
     */
    public function getPreOrdersLeft()
    {
        return $this->preOrdersLeft;
    }

    /**
     * @return int
     */
    public function getTotalNumberOfPreOrders()
    {
        return $this->totalNumberOfPreOrders;
    }

    /**
     * @return array
     */
    public function getLinksToAdd()
    {
        return $this->linksToAdd;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }
}