<?php

namespace CodesWholesaleFramework\Utils;
/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 06/06/16
 * Time: 17:14
 */
class MathUtil
{
    /**
     * @param int/float $a
     * @param int/float $b
     * @return float
     */
    public static function addTwoNumbers($a, $b) {
        return floatval($a + $b);
    }

    /**
     * @param int/float $a
     * @param int/float $percent
     * @return float
     */
    public static function countPercentOf($a, $percent) {
        $result = $a / 100 * $percent + $a;
        return round($result, 2);
    }
}