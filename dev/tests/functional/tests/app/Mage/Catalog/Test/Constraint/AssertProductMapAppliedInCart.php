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

use Mage\Cms\Test\Page\CmsIndex;
use Magento\Mtf\Constraint\AbstractConstraint;
use Mage\Catalog\Test\Fixture\CatalogCategory;
use Mage\Catalog\Test\Page\Category\CatalogCategoryView;
use Mage\Catalog\Test\Page\Product\CatalogProductView;
use Mage\Checkout\Test\Page\CheckoutCart;

/**
 * Assert that products' MAP has been applied and price is visible in cart.
 */
class AssertProductMapAppliedInCart extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert that product products' MAP has been applied in cart.
     *
     * @param CatalogCategoryView $catalogCategoryView
     * @param CmsIndex $cmsIndex
     * @param CatalogCategory $category
     * @param CatalogProductView $catalogProductView
     * @param CheckoutCart $cart
     * @param array $products
     * @return void
     */
    public function processAssert(
        CatalogCategoryView $catalogCategoryView,
        CmsIndex $cmsIndex,
        CatalogCategory $category,
        CatalogProductView $catalogProductView,
        CheckoutCart $cart,
        array $products
    ) {
        foreach ($products as $product) {
            $cart->getCartBlock()->clearShoppingCart();
            $productName = $product->getName();
            $cmsIndex->open();
            $cmsIndex->getTopmenu()->selectCategory($category->getName());
            $listProductBlock = $catalogCategoryView->getListProductBlock();

            // Check that price is not present on category page.
            $productPriceBlock = $listProductBlock->getProductPriceBlock($productName);
            $productPriceBlock->clickForPrice();
            \PHPUnit_Framework_Assert::assertFalse(
                $productPriceBlock->getMapBlock()->isPriceVisible(),
                'Price is present in MSRP dialog on category page.'
            );

            // Check that price is not present on product page.
            $listProductBlock->openProductViewPage($productName);
            \PHPUnit_Framework_Assert::assertFalse(
                $catalogProductView->getViewBlock()->getPriceBlock()->isRegularPriceVisible(),
                'Price is present in View block on product page.'
            );

            // Check that price is present in cart.
            $catalogProductView->getViewBlock()->addToCart($product);
            \PHPUnit_Framework_Assert::assertEquals(
                number_format($product->getPrice(), 2),
                $cart->getCartBlock()->getCartItem($product)->getCartItemTypePrice('price'),
                "MAP of $productName product in cart is not equal to product price."
            );
        }
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return "Products' MAP has been applied in cart.";
    }
}
