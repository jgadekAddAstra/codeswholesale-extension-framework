<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 21/06/16
 * Time: 14:33
 */

namespace CodesWholesaleFramework\Domain;

interface ExternalCodes
{
    public function isImage();

    public function isPreOrder();

    public function isText();

    public function getFileName();

    public function getCode();

    public function getHref();
}