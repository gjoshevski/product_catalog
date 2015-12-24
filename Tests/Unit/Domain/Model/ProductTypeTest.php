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
 * Test case for class \TEND\ProductCatalog\Domain\Model\ProductType.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Martin Gjoshevski <martin.gjoshevski@tend.si>
 */
class ProductTypeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \TEND\ProductCatalog\Domain\Model\ProductType
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \TEND\ProductCatalog\Domain\Model\ProductType();
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
	public function getSectionsReturnsInitialValueForSection() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSections()
		);
	}

	/**
	 * @test
	 */
	public function setSectionsForObjectStorageContainingSectionSetsSections() {
		$section = new \TEND\ProductCatalog\Domain\Model\Section();
		$objectStorageHoldingExactlyOneSections = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSections->attach($section);
		$this->subject->setSections($objectStorageHoldingExactlyOneSections);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSections,
			'sections',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSectionToObjectStorageHoldingSections() {
		$section = new \TEND\ProductCatalog\Domain\Model\Section();
		$sectionsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$sectionsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($section));
		$this->inject($this->subject, 'sections', $sectionsObjectStorageMock);

		$this->subject->addSection($section);
	}

	/**
	 * @test
	 */
	public function removeSectionFromObjectStorageHoldingSections() {
		$section = new \TEND\ProductCatalog\Domain\Model\Section();
		$sectionsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$sectionsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($section));
		$this->inject($this->subject, 'sections', $sectionsObjectStorageMock);

		$this->subject->removeSection($section);

	}
}
