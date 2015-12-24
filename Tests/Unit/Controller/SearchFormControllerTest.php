<?php
namespace TEND\ProductCatalog\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
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
 * Test case for class TEND\ProductCatalog\Controller\SearchFormController.
 *
 */
class SearchFormControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \TEND\ProductCatalog\Controller\SearchFormController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('TEND\\ProductCatalog\\Controller\\SearchFormController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenSearchFormToSearchFormRepository() {
		$searchForm = new \TEND\ProductCatalog\Domain\Model\SearchForm();

		$searchFormRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$searchFormRepository->expects($this->once())->method('add')->with($searchForm);
		$this->inject($this->subject, 'searchFormRepository', $searchFormRepository);

		$this->subject->createAction($searchForm);
	}
}