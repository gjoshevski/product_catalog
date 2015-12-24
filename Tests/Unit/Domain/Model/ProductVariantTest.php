<?php

namespace TEND\ProductCatalog\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Martin Gjoshevski <martin.gjoshevski@tend.si>, org. Tend
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \TEND\ProductCatalog\Domain\Model\ProductVariant.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Martin Gjoshevski <martin.gjoshevski@tend.si>
 */
class ProductVariantTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \TEND\ProductCatalog\Domain\Model\ProductVariant
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \TEND\ProductCatalog\Domain\Model\ProductVariant();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVariationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getVariation()
		);
	}

	/**
	 * @test
	 */
	public function setVariationForStringSetsVariation() {
		$this->subject->setVariation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'variation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForPrice() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForObjectStorageContainingPriceSetsPrice() {
		$price = new \TEND\ProductCatalog\Domain\Model\Price();
		$objectStorageHoldingExactlyOnePrice = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePrice->attach($price);
		$this->subject->setPrice($objectStorageHoldingExactlyOnePrice);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePrice,
			'price',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPriceToObjectStorageHoldingPrice() {
		$price = new \TEND\ProductCatalog\Domain\Model\Price();
		$priceObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$priceObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($price));
		$this->inject($this->subject, 'price', $priceObjectStorageMock);

		$this->subject->addPrice($price);
	}

	/**
	 * @test
	 */
	public function removePriceFromObjectStorageHoldingPrice() {
		$price = new \TEND\ProductCatalog\Domain\Model\Price();
		$priceObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$priceObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($price));
		$this->inject($this->subject, 'price', $priceObjectStorageMock);

		$this->subject->removePrice($price);

	}

	/**
	 * @test
	 */
	public function getStockReturnsInitialValueForStock() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getStock()
		);
	}

	/**
	 * @test
	 */
	public function setStockForObjectStorageContainingStockSetsStock() {
		$stock = new \TEND\ProductCatalog\Domain\Model\Stock();
		$objectStorageHoldingExactlyOneStock = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneStock->attach($stock);
		$this->subject->setStock($objectStorageHoldingExactlyOneStock);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneStock,
			'stock',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addStockToObjectStorageHoldingStock() {
		$stock = new \TEND\ProductCatalog\Domain\Model\Stock();
		$stockObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$stockObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($stock));
		$this->inject($this->subject, 'stock', $stockObjectStorageMock);

		$this->subject->addStock($stock);
	}

	/**
	 * @test
	 */
	public function removeStockFromObjectStorageHoldingStock() {
		$stock = new \TEND\ProductCatalog\Domain\Model\Stock();
		$stockObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$stockObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($stock));
		$this->inject($this->subject, 'stock', $stockObjectStorageMock);

		$this->subject->removeStock($stock);

	}

	/**
	 * @test
	 */
	public function getProductCodeReturnsInitialValueForProductCode() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getProductCode()
		);
	}

	/**
	 * @test
	 */
	public function setProductCodeForObjectStorageContainingProductCodeSetsProductCode() {
		$productCode = new \TEND\ProductCatalog\Domain\Model\ProductCode();
		$objectStorageHoldingExactlyOneProductCode = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneProductCode->attach($productCode);
		$this->subject->setProductCode($objectStorageHoldingExactlyOneProductCode);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneProductCode,
			'productCode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addProductCodeToObjectStorageHoldingProductCode() {
		$productCode = new \TEND\ProductCatalog\Domain\Model\ProductCode();
		$productCodeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$productCodeObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($productCode));
		$this->inject($this->subject, 'productCode', $productCodeObjectStorageMock);

		$this->subject->addProductCode($productCode);
	}

	/**
	 * @test
	 */
	public function removeProductCodeFromObjectStorageHoldingProductCode() {
		$productCode = new \TEND\ProductCatalog\Domain\Model\ProductCode();
		$productCodeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$productCodeObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($productCode));
		$this->inject($this->subject, 'productCode', $productCodeObjectStorageMock);

		$this->subject->removeProductCode($productCode);

	}
}
