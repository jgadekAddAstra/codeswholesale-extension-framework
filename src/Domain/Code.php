<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 21/06/16
 * Time: 16:32
 */

namespace CodesWholesaleFramework\Domain;


interface Code
{
    public function isPreOrder();
    public function isImage();
    public function isText();
    public function getFileName();
    public function getCode();
    public function getHref();
}