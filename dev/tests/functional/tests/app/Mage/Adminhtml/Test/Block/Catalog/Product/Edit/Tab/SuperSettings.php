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

namespace Mage\Adminhtml\Test\Block\Catalog\Product\Edit\Tab;

use Magento\Mtf\Client\Element\SimpleElement as Element;
use Mage\Adminhtml\Test\Block\Widget\Tab;

/**
 * Product super settings tab.
 */
class SuperSettings extends Tab
{
    /**
     * 'Continue' button css selector.
     *
     * @var string
     */
    protected $continue = '#continue_button button';

    /**
     * Fill data to fields on tab.
     *
     * @param array $fields
     * @param Element|null $element
     * @return $this
     */
    public function fillFormTab(array $fields, Element $element = null)
    {
        $context = $element ? $element : $this->_rootElement;
        $data = [];
        $mapping = $this->dataMapping(['attribute' => '']);
        $formatSelector = $mapping['attribute']['selector'];
        foreach($fields['attribute']['value'] as $attribute) {
            $mapping['attribute']['selector'] = sprintf($formatSelector, $attribute->getFrontendLabel());
            $mapping['attribute']['value'] = 'Yes';
            $data[] = $mapping['attribute'];
        }

        $this->_fill($data, $context);
        $context->find($this->continue)->click();

        return $this;
    }
}
