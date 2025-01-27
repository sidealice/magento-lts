<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Tests
 * @package    Tests_Functional
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Mage\Catalog\Test\Block\Product\ProductList;

use Magento\Mtf\Block\Block;

/**
 * Top toolbar the product list page.
 */
class TopToolbar extends Block
{
    /**
     * Selector for "sort by" element.
     *
     * @var string
     */
    protected $sorter = '.sorter .sort-by [selected="selected"]';

    /**
     * Get method of sorting product.
     *
     * @return string
     */
    public function getSelectSortType()
    {
        return strtolower($this->_rootElement->find($this->sorter)->getText());
    }
}
