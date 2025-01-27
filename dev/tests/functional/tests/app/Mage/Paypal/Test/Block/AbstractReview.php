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

namespace Mage\Paypal\Test\Block;

use Magento\Mtf\Block\Block;

/**
 * Abstract Pay Pal sandbox review block.
 */
abstract class AbstractReview extends Block
{
    /**
     * Continue button selector.
     *
     * @var string
     */
    protected $continue = '';

    /**
     * Log out button selector.
     *
     * @var string
     */
    protected $logoutButton = '';

    /**
     * Change shipping button selector.
     *
     * @var string
     */
    protected $changeShipping = '';

    /**
     * Addresses block selector.
     *
     * @var string
     */
    protected $addresses = '';

    /**
     * Shipping notification.
     *
     * @var string
     */
    protected $shipNotification = '';

    /**
     * Loader selector.
     *
     * @var string
     */
    protected $loader = '';

    /**
     * Get addresses block.
     *
     * @return Addresses
     */
    abstract public function getAddressesBlock();

    /**
     * Click 'Continue' button.
     *
     * @return void
     */
    public function continueCheckout()
    {
        $this->_rootElement->find($this->continue)->click();
    }

    /**
     * Log out from Pay Pal account.
     *
     * @return void
     */
    public function logOut()
    {
        $this->waitLoader();
        $logoutButton = $this->_rootElement->find($this->logoutButton);
        if ($logoutButton->isVisible()) {
            $logoutButton->click();
            $this->waitLoader();
        }
    }

    /**
     * Check change shipping button.
     *
     * @return bool
     */
    public function checkChangeShippingButton()
    {
        return $this->_rootElement->find($this->changeShipping)->isVisible();
    }

    /**
     * Check for shipping notification.
     *
     * @return bool
     */
    protected function checkShippingNotification()
    {
        return $this->_rootElement->find($this->shipNotification)->isVisible();
    }

    /**
     * Click change shipping button.
     *
     * @return void
     */
    public function clickChangeShippingButton()
    {
        $this->_rootElement->find($this->changeShipping)->click();
    }

    /**
     * Wait loader.
     *
     * @return void
     */
    public function waitLoader()
    {
        $this->waitForElementNotVisible($this->loader);
    }

    /**
     * Check change address ability.
     *
     * @return bool
     */
    public function checkChangeAddressAbility()
    {
        $this->waitLoader();
        if ($this->checkChangeShippingButton()) {
            $this->clickChangeShippingButton();
            $this->waitLoader();
            return !$this->checkShippingNotification();
        } else {
            return false;
        }
    }
}
