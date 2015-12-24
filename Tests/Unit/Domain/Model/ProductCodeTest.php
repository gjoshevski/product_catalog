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
 * Test case for class \TEND\ProductCatalog\Domain\Model\ProductCode.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Martin Gjoshevski <martin.gjoshevski@tend.si>
 */
class ProductCodeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \TEND\ProductCatalog\Domain\Model\ProductCode
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \TEND\ProductCatalog\Domain\Model\ProductCode();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getCodeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCode()
		);
	}

	/**
	 * @test
	 */
	public function setCodeForStringSetsCode() {
		$this->subject->setCode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'code',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCodeTypeReturnsInitialValueForCodeType() {
		$this->assertEquals(
			NULL,
			$this->subject->getCodeType()
		);
	}

	/**
	 * @test
	 */
	public function setCodeTypeForCodeTypeSetsCodeType() {
		$codeTypeFixture = new \TEND\ProductCatalog\Domain\Model\CodeType();
		$this->subject->setCodeType($codeTypeFixture);

		$this->assertAttributeEquals(
			$codeTypeFixture,
			'codeType',
			$this->subject
		);
	}
}
