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
 * Test case for class \TEND\ProductCatalog\Domain\Model\ProductProperty.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Martin Gjoshevski <martin.gjoshevski@tend.si>
 */
class ProductPropertyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \TEND\ProductCatalog\Domain\Model\ProductProperty
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \TEND\ProductCatalog\Domain\Model\ProductProperty();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getValueReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getValue()
		);
	}

	/**
	 * @test
	 */
	public function setValueForStringSetsValue() {
		$this->subject->setValue('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'value',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPropertyReturnsInitialValueForProperty() {
		$this->assertEquals(
			NULL,
			$this->subject->getProperty()
		);
	}

	/**
	 * @test
	 */
	public function setPropertyForPropertySetsProperty() {
		$propertyFixture = new \TEND\ProductCatalog\Domain\Model\Property();
		$this->subject->setProperty($propertyFixture);

		$this->assertAttributeEquals(
			$propertyFixture,
			'property',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPropertyOptionReturnsInitialValueForPropertyOptions() {
		$this->assertEquals(
			NULL,
			$this->subject->getPropertyOption()
		);
	}

	/**
	 * @test
	 */
	public function setPropertyOptionForPropertyOptionsSetsPropertyOption() {
		$propertyOptionFixture = new \TEND\ProductCatalog\Domain\Model\PropertyOptions();
		$this->subject->setPropertyOption($propertyOptionFixture);

		$this->assertAttributeEquals(
			$propertyOptionFixture,
			'propertyOption',
			$this->subject
		);
	}
}
