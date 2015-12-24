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
 * Test case for class \TEND\ProductCatalog\Domain\Model\Variant.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Martin Gjoshevski <martin.gjoshevski@tend.si>
 */
class VariantTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \TEND\ProductCatalog\Domain\Model\Variant
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \TEND\ProductCatalog\Domain\Model\Variant();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getPropertyReturnsInitialValueForProductProperty() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getProperty()
		);
	}

	/**
	 * @test
	 */
	public function setPropertyForObjectStorageContainingProductPropertySetsProperty() {
		$property = new \TEND\ProductCatalog\Domain\Model\ProductProperty();
		$objectStorageHoldingExactlyOneProperty = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneProperty->attach($property);
		$this->subject->setProperty($objectStorageHoldingExactlyOneProperty);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneProperty,
			'property',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPropertyToObjectStorageHoldingProperty() {
		$property = new \TEND\ProductCatalog\Domain\Model\ProductProperty();
		$propertyObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$propertyObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($property));
		$this->inject($this->subject, 'property', $propertyObjectStorageMock);

		$this->subject->addProperty($property);
	}

	/**
	 * @test
	 */
	public function removePropertyFromObjectStorageHoldingProperty() {
		$property = new \TEND\ProductCatalog\Domain\Model\ProductProperty();
		$propertyObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$propertyObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($property));
		$this->inject($this->subject, 'property', $propertyObjectStorageMock);

		$this->subject->removeProperty($property);

	}
}
