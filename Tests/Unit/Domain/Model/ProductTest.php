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
 * Test case for class \TEND\ProductCatalog\Domain\Model\Product.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Martin Gjoshevski <martin.gjoshevski@tend.si>
 */
class ProductTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \TEND\ProductCatalog\Domain\Model\Product
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \TEND\ProductCatalog\Domain\Model\Product();
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
	public function getFilesReturnsInitialValueForFileReference() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getFiles()
		);
	}

	/**
	 * @test
	 */
	public function setFilesForFileReferenceSetsFiles() {
		$file = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$objectStorageHoldingExactlyOneFiles = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneFiles->attach($file);
		$this->subject->setFiles($objectStorageHoldingExactlyOneFiles);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneFiles,
			'files',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addFileToObjectStorageHoldingFiles() {
		$file = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$filesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$filesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($file));
		$this->inject($this->subject, 'files', $filesObjectStorageMock);

		$this->subject->addFile($file);
	}

	/**
	 * @test
	 */
	public function removeFileFromObjectStorageHoldingFiles() {
		$file = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$filesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$filesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($file));
		$this->inject($this->subject, 'files', $filesObjectStorageMock);

		$this->subject->removeFile($file);

	}

	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForFileReference() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getImages()
		);
	}

	/**
	 * @test
	 */
	public function setImagesForFileReferenceSetsImages() {
		$image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$objectStorageHoldingExactlyOneImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneImages->attach($image);
		$this->subject->setImages($objectStorageHoldingExactlyOneImages);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneImages,
			'images',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addImageToObjectStorageHoldingImages() {
		$image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$imagesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$imagesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($image));
		$this->inject($this->subject, 'images', $imagesObjectStorageMock);

		$this->subject->addImage($image);
	}

	/**
	 * @test
	 */
	public function removeImageFromObjectStorageHoldingImages() {
		$image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$imagesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$imagesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($image));
		$this->inject($this->subject, 'images', $imagesObjectStorageMock);

		$this->subject->removeImage($image);

	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForProductType() {
		$this->assertEquals(
			NULL,
			$this->subject->getType()
		);
	}

	/**
	 * @test
	 */
	public function setTypeForProductTypeSetsType() {
		$typeFixture = new \TEND\ProductCatalog\Domain\Model\ProductType();
		$this->subject->setType($typeFixture);

		$this->assertAttributeEquals(
			$typeFixture,
			'type',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPropertiesReturnsInitialValueForProductProperty() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getProperties()
		);
	}

	/**
	 * @test
	 */
	public function setPropertiesForObjectStorageContainingProductPropertySetsProperties() {
		$property = new \TEND\ProductCatalog\Domain\Model\ProductProperty();
		$objectStorageHoldingExactlyOneProperties = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneProperties->attach($property);
		$this->subject->setProperties($objectStorageHoldingExactlyOneProperties);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneProperties,
			'properties',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPropertyToObjectStorageHoldingProperties() {
		$property = new \TEND\ProductCatalog\Domain\Model\ProductProperty();
		$propertiesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$propertiesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($property));
		$this->inject($this->subject, 'properties', $propertiesObjectStorageMock);

		$this->subject->addProperty($property);
	}

	/**
	 * @test
	 */
	public function removePropertyFromObjectStorageHoldingProperties() {
		$property = new \TEND\ProductCatalog\Domain\Model\ProductProperty();
		$propertiesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$propertiesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($property));
		$this->inject($this->subject, 'properties', $propertiesObjectStorageMock);

		$this->subject->removeProperty($property);

	}

	/**
	 * @test
	 */
	public function getCategoriesReturnsInitialValueForCategory() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function setCategoriesForObjectStorageContainingCategorySetsCategories() {
		$category = new \TEND\ProductCatalog\Domain\Model\Category();
		$objectStorageHoldingExactlyOneCategories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCategories->attach($category);
		$this->subject->setCategories($objectStorageHoldingExactlyOneCategories);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCategories,
			'categories',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCategoryToObjectStorageHoldingCategories() {
		$category = new \TEND\ProductCatalog\Domain\Model\Category();
		$categoriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$categoriesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($category));
		$this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

		$this->subject->addCategory($category);
	}

	/**
	 * @test
	 */
	public function removeCategoryFromObjectStorageHoldingCategories() {
		$category = new \TEND\ProductCatalog\Domain\Model\Category();
		$categoriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$categoriesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($category));
		$this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

		$this->subject->removeCategory($category);

	}

	/**
	 * @test
	 */
	public function getRelatedProductsReturnsInitialValueForProduct() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getRelatedProducts()
		);
	}

	/**
	 * @test
	 */
	public function setRelatedProductsForObjectStorageContainingProductSetsRelatedProducts() {
		$relatedProduct = new \TEND\ProductCatalog\Domain\Model\Product();
		$objectStorageHoldingExactlyOneRelatedProducts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneRelatedProducts->attach($relatedProduct);
		$this->subject->setRelatedProducts($objectStorageHoldingExactlyOneRelatedProducts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneRelatedProducts,
			'relatedProducts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addRelatedProductToObjectStorageHoldingRelatedProducts() {
		$relatedProduct = new \TEND\ProductCatalog\Domain\Model\Product();
		$relatedProductsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$relatedProductsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($relatedProduct));
		$this->inject($this->subject, 'relatedProducts', $relatedProductsObjectStorageMock);

		$this->subject->addRelatedProduct($relatedProduct);
	}

	/**
	 * @test
	 */
	public function removeRelatedProductFromObjectStorageHoldingRelatedProducts() {
		$relatedProduct = new \TEND\ProductCatalog\Domain\Model\Product();
		$relatedProductsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$relatedProductsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($relatedProduct));
		$this->inject($this->subject, 'relatedProducts', $relatedProductsObjectStorageMock);

		$this->subject->removeRelatedProduct($relatedProduct);

	}

	/**
	 * @test
	 */
	public function getVariantsReturnsInitialValueForProductVariant() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getVariants()
		);
	}

	/**
	 * @test
	 */
	public function setVariantsForObjectStorageContainingProductVariantSetsVariants() {
		$variant = new \TEND\ProductCatalog\Domain\Model\ProductVariant();
		$objectStorageHoldingExactlyOneVariants = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneVariants->attach($variant);
		$this->subject->setVariants($objectStorageHoldingExactlyOneVariants);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneVariants,
			'variants',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addVariantToObjectStorageHoldingVariants() {
		$variant = new \TEND\ProductCatalog\Domain\Model\ProductVariant();
		$variantsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$variantsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($variant));
		$this->inject($this->subject, 'variants', $variantsObjectStorageMock);

		$this->subject->addVariant($variant);
	}

	/**
	 * @test
	 */
	public function removeVariantFromObjectStorageHoldingVariants() {
		$variant = new \TEND\ProductCatalog\Domain\Model\ProductVariant();
		$variantsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$variantsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($variant));
		$this->inject($this->subject, 'variants', $variantsObjectStorageMock);

		$this->subject->removeVariant($variant);

	}

	/**
	 * @test
	 */
	public function getPackageProductsReturnsInitialValueForProduct() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPackageProducts()
		);
	}

	/**
	 * @test
	 */
	public function setPackageProductsForObjectStorageContainingProductSetsPackageProducts() {
		$packageProduct = new \TEND\ProductCatalog\Domain\Model\Product();
		$objectStorageHoldingExactlyOnePackageProducts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePackageProducts->attach($packageProduct);
		$this->subject->setPackageProducts($objectStorageHoldingExactlyOnePackageProducts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePackageProducts,
			'packageProducts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPackageProductToObjectStorageHoldingPackageProducts() {
		$packageProduct = new \TEND\ProductCatalog\Domain\Model\Product();
		$packageProductsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$packageProductsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($packageProduct));
		$this->inject($this->subject, 'packageProducts', $packageProductsObjectStorageMock);

		$this->subject->addPackageProduct($packageProduct);
	}

	/**
	 * @test
	 */
	public function removePackageProductFromObjectStorageHoldingPackageProducts() {
		$packageProduct = new \TEND\ProductCatalog\Domain\Model\Product();
		$packageProductsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$packageProductsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($packageProduct));
		$this->inject($this->subject, 'packageProducts', $packageProductsObjectStorageMock);

		$this->subject->removePackageProduct($packageProduct);

	}
}
