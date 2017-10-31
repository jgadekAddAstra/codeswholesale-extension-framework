<?php
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 01/06/16
 * Time: 11:13
 */

namespace CodesWholesaleFramework\Utils;

use CodesWholesaleFramework\Exceptions\InvalidUrlException;
use CodesWholesaleFramework\Exceptions\LocationNotFoundException;

class UrlHeader
{
    const LOCATION = 'Location';

    /**
     * @param $url
     * @return string
     * @throws InvalidUrlException
     * @throws LocationNotFoundException
     */
    public function getTargetUrl($url) {

        if(!filter_var($url, FILTER_VALIDATE_URL) === false) {

            $headers = get_headers($url, 1);

            if(!isset($headers[self::LOCATION]))
                throw new LocationNotFoundException;

            return $headers[self::LOCATION];
        }
        throw new InvalidUrlException;
    }
}