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

namespace Mage\Adminhtml\Test\Block\Sales\Order\Create\Items;

use Magento\Mtf\Block\Form;

/**
 * Item product block.
 */
class ItemProduct extends Form
{
    /**
     * Actions for fields.
     *
     * @var array
     */
    protected $actions = [
        'name' => 'getText',
        'price' => 'getText',
        'qty' => 'getValue',
        'checkout_data' => 'getValue',
    ];

    /**
     * Error message selector.
     *
     * @var string
     */
    protected $errorMessage = ".error";

    /**
     * Notice message selector.
     *
     * @var string
     */
    protected $noticeMessage = ".notice";

    /**
     * Fill product options.
     *
     * @param array $options
     */
   public function fillProductOptions(array $options)
   {
       if (isset($options['cartItem'])) {
           unset($options['cartItem']);
       }
       if (isset($options['options'])) {
           unset($options['options']);
       }

       $mapping = $this->dataMapping($options);
       $this->_fill($mapping);
   }

    /**
     * Get data item products.
     *
     * @param array $fields
     * @param string $currency [optional]
     * @return array
     */
    public function getCheckoutData(array $fields, $currency = '$')
    {
        $result = [];
        $data = $this->dataMapping($fields);
        foreach ($data as $key => $item) {
            if (!isset($item['value'])) {
                $result[$key] = $this->getCheckoutData($item);
                continue;
            }
            $value = $this->_rootElement->find($item['selector'], $item['strategy'], $item['input'])
                ->{$this->actions[$key]}();

            $result[$key] = str_replace($currency, '', trim($value));
        }

        return $result;
    }

    /**
     * Get error message.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_rootElement->find($this->errorMessage)->getText();
    }

    /**
     * Get notice message.
     *
     * @return string
     */
    public function getNoticeMessage()
    {
        return $this->_rootElement->find($this->noticeMessage)->getText();
    }
}
