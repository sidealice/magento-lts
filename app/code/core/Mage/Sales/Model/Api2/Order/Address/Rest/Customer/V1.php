<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Mage
 * @package    Mage_Sales
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * API2 class for order address (customer)
 *
 * @category   Mage
 * @package    Mage_Sales
 */
class Mage_Sales_Model_Api2_Order_Address_Rest_Customer_V1 extends Mage_Sales_Model_Api2_Order_Address_Rest
{
    /**
     * Retrieve collection instances
     *
     * @return Mage_Sales_Model_Resource_Order_Address_Collection
     */
    protected function _getCollectionForRetrieve()
    {
        $collection = parent::_getCollectionForRetrieve();
        $collection->addAttributeToFilter('customer_id', $this->getApiUser()->getUserId());

        return $collection;
    }
}
