<?php
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

namespace CodesWholesaleFramework\Postback\Extractor;
use CodesWholesaleFramework\Domain\ExtractedKeys;
use CodesWholesaleFramework\Postback\ExternalCodeList;
use CodesWholesaleFramework\Postback\InternalProduct;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 06/07/15
 * Time: 15:59
 */

interface NewKeysExtractor {

   /**
    * @param InternalProduct $product
    * @param ExternalCodeList $codeList
    * @return ExtractedKeys
    */
   public function extract(InternalProduct $product, ExternalCodeList $codeList);

}