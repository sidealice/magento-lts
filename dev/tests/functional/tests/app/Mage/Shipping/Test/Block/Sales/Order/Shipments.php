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

namespace Mage\Shipping\Test\Block\Sales\Order;

use Mage\Sales\Test\Block\Order\AbstractSalesEntities;

/**
 * Shipment block on 'My Account'.
 */
class Shipments extends AbstractSalesEntities
{
    /**
     * Item entity class.
     *
     * @var string
     */
    protected $itemEntityClass = 'Mage\Shipping\Test\Block\Sales\Order\Shipments\Shipment';
}
