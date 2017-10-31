<?php
namespace CodesWholesaleFramework\Postback\UpdatePriceAndStock;
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
use CodesWholesaleFramework\Domain\SpreadData;
use CodesWholesaleFramework\Exceptions\InvalidSpreadTypeException;
use CodesWholesaleFramework\Utils\MathUtil;

class SpreadCalculatorImpl implements SpreadCalculator
{
    const CONSTANT = 0;
    const PERCENT = 1;

    /**
     * @param SpreadData $spreadData
     * @param $price
     * @return float
     * @throws InvalidSpreadTypeException
     */
    public function calculateSpread(SpreadData $spreadData, $price)
    {
        if ($spreadData->getSpreadType() == self::CONSTANT) {

            return MathUtil::addTwoNumbers($price, $spreadData->getSpreadValue());

        } else if ($spreadData->getSpreadType() == self::PERCENT) {

            return MathUtil::countPercentOf($price, $spreadData->getSpreadValue());

        } else {
            throw new InvalidSpreadTypeException;
        }
    }
}