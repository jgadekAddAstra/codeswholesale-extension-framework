<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 22/06/16
 * Time: 16:27
 */

namespace CodesWholesaleFramework\Utils;
use CodesWholesaleFramework\Postback\ExternalCodeList;

class Links
{
    /**
     * @var array
     */
    private $links = array();

    /**
     * @var int
     */
    private $preOrders = 0;

    /**
     * @var ExternalCodeList
     */
    private $externalCodeList;

    /**
     * Links constructor.
     * @param ExternalCodeList $externalCodeList
     */
    public function __construct(ExternalCodeList $externalCodeList)
    {
        $this->externalCodeList = $externalCodeList;
    }

    /**
     * @return array
     */
     public function getLinksFromCodeList() {

        foreach ($this->externalCodeList->getCodes() as $code) {

            if ($code->isPreOrder()) {

                $this->preOrders++;
            }

            $this->links[] = $code->getHref();
        }

        return $this->links;
    }

    /**
     * @return int
     */
     public function getNumberOfPreOrders(){
        return $this->preOrders;
    }
}