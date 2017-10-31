<?php

use CodesWholesaleFramework\bootstrap\AutoLoader;

require_once (dirname(__DIR__) . '/vendor/autoload.php');
include_once('AutoLoader.php');
AutoLoader::registerNamespace('CodesWholesaleFramework', __DIR__);
AutoLoader::registerDirectory(dirname(__DIR__) . '/tests');

