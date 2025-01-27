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

namespace Mage\Sales\Test\TestStep;

use Mage\Sales\Test\Page\Adminhtml\SalesOrderCreateIndex;
use Magento\Mtf\TestStep\TestStepInterface;

/**
 * Select Shipping data.
 */
class SelectShippingMethodForOrderStep implements TestStepInterface
{
    /**
     * Sales order create index page.
     *
     * @var SalesOrderCreateIndex
     */
    protected $salesOrderCreateIndex;

    /**
     * Shipping method data.
     *
     * @var array
     */
    protected $shipping;

    /**
     * @constructor
     * @param SalesOrderCreateIndex $salesOrderCreateIndex
     * @param array $shipping
     */
    public function __construct(SalesOrderCreateIndex $salesOrderCreateIndex, array $shipping)
    {
        $this->salesOrderCreateIndex = $salesOrderCreateIndex;
        $this->shipping = $shipping;
    }

    /**
     * Fill Shipping Data.
     *
     * @return array
     */
    public function run()
    {
        if ($this->shipping['shipping_service'] != '-') {
            $this->salesOrderCreateIndex->getCreateBlock()->getShippingBlock()->selectShippingMethod($this->shipping);
        }
    }
}
