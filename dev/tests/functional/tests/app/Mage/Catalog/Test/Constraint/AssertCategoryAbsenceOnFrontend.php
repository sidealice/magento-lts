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

namespace Mage\Catalog\Test\Constraint;

use Mage\Catalog\Test\Fixture\CatalogCategory;
use Mage\Catalog\Test\Page\Category\CatalogCategoryView;
use Magento\Mtf\Client\Browser;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 * Assert category is not present on frontend.
 */
class AssertCategoryAbsenceOnFrontend extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Message on the category page 404.
     */
    const NOT_FOUND_MESSAGE = 'The page you requested was not found, and we have a fine guess why.';

    /**
     * Assert category is not present on frontend.
     *
     * @param Browser $browser
     * @param CatalogCategoryView $categoryView
     * @param CatalogCategory $category
     * @param string|null $notFoundMessage
     * @return void
     */
    public function processAssert(
        Browser $browser,
        CatalogCategoryView $categoryView,
        CatalogCategory $category,
        $notFoundMessage = null
    ) {
        $browser->open($_ENV['app_frontend_url'] . $category->getUrlKey() . '.html');
        $notFoundMessage = ($notFoundMessage !== null) ? $notFoundMessage : self::NOT_FOUND_MESSAGE;
        \PHPUnit_Framework_Assert::assertContains(
            $notFoundMessage,
            $categoryView->getViewBlock()->getText(),
            'Category is present on frontend.'
        );
    }

    /**
     * Returns string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Category is absent on frontend.';
    }
}
