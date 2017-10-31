<?php

namespace CodesWholesaleFramework\Postback\ReceivePreOrders;

/**
 *   This file is part of codeswholesale-plugin-framework.
 *
 *   codeswholesale-plugin-framework is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   codeswholesale-plugin-framework is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with codeswholesale-plugin-framework; if not, write to the Free Software
 *   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
use CodesWholesaleFramework\Domain\ExtractedKeys;
use CodesWholesaleFramework\Postback\ExternalCodeList;
use CodesWholesaleFramework\Postback\Extractor\NewKeysExtractor;
use CodesWholesaleFramework\Postback\ImageWriter;
use CodesWholesaleFramework\Postback\InternalProduct;

class NewKeysExtractorImpl implements NewKeysExtractor
{
    const FILE_NAME = "cw_attachments";

    /**
     * @var int
     */
    private $numberOfKeysSent = 0;

    /**
     * @var array
     */
    private $attachments = array();

    /**
     * @var array
     */
    private $linksToAdd = array();

    /**
     * @var ImageWriter
     */
    private $imageWriter;

    /**
     * NewKeysExtractorImpl constructor.
     * @param ImageWriter $imageWriter
     */
    public function __construct(ImageWriter $imageWriter)
    {
        $this->imageWriter = $imageWriter;
    }

    /**
     * @param InternalProduct $product
     * @param ExternalCodeList $codeList
     * @return ExtractedKeys
     */
    public function extract(InternalProduct $product, ExternalCodeList $codeList)
    {
        $links = json_decode($product->getLinks());
        $numberOfPreOrders = $product->getNumberOfPreOrders();

        $preOrdersToRemove = $this->getIndicesOfPreOrders($links, $codeList);
        $newCodes = $this->getNewCodes($links, $codeList);

        $this->writeImageCodes($newCodes, $links, $preOrdersToRemove);
        $preOrdersLeft = $this->getNumberOfPreOrdersToSend($numberOfPreOrders);

        $totalNumberOfLinks = $this->getTotalNumberOfLinks($links);

        return new ExtractedKeys($product, $newCodes, $preOrdersLeft, $totalNumberOfLinks, $this->linksToAdd, $links, $this->attachments);
    }

    /**
     * @param $links
     * @return int
     */
    private function getTotalNumberOfLinks(array $links)
    {
        return (int) count($links);
    }

    private function writeImageCodes($newCodes, $links, $preOrdersToRemove)
    {
        foreach ($newCodes as $code) {

            if ($code->isImage()) {
                $this->attachments[] = $this->imageWriter->write($code, self::FILE_NAME);
            }

            $this->deleteLinksAndPreOrders($links, $preOrdersToRemove);

            $this->linksToAdd[] = $code->getHref();
            $this->numberOfKeysSent++;
        }
    }

    private function deleteLinksAndPreOrders($links, $preOrdersToRemove) {
        unset($links[$preOrdersToRemove[0]]);
        unset($preOrdersToRemove[0]);
    }

    /**
     * @param $numberOfPreOrders
     * @return int
     */
    private function getNumberOfPreOrdersToSend($numberOfPreOrders) {
        return (int) ($numberOfPreOrders - $this->numberOfKeysSent);
    }

    /**
     * @param $links
     * @param $codes
     * @return array
     */
    private function getIndicesOfPreOrders($links, $codes)
    {
        $indices = array();

        foreach ($links as $index => $link) {
            $isPreOrder = true;
            foreach ($codes as $code) {

                if ($link == $code->getHref()) {
                    $isPreOrder = false;
                }
            }

            if ($isPreOrder) {

                $indices[] = $index;
            }
        }
        return $indices;
    }

    /**
     * @param $links
     * @param $codes
     * @return array
     */
    private function getNewCodes($links, $codes)
    {
        $newCodes = array();
        foreach ($codes as $code) {
            $isNew = true;
            foreach ($links as $link) {
                if ($link == $code->getHref()) {
                    $isNew = false;
                }
            }
            if ($isNew) {
                $newCodes[] = $code;
            }
        }
        return $newCodes;
    }
}