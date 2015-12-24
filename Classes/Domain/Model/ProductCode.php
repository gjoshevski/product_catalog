<?php
namespace TEND\ProductCatalog\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Martin Gjoshevski <martin.gjoshevski@tend.si>, org. Tend
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * ProductCode
 */
class ProductCode extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * code
	 *
	 * @var string
	 */
	protected $code = '';

	/**
	 * codeType
	 *
	 * @var \TEND\ProductCatalog\Domain\Model\CodeType
	 */
	protected $codeType = NULL;

	/**
	 * Returns the code
	 *
	 * @return string $code
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * Sets the code
	 *
	 * @param string $code
	 * @return void
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * Returns the codeType
	 *
	 * @return \TEND\ProductCatalog\Domain\Model\CodeType $codeType
	 */
	public function getCodeType() {
		return $this->codeType;
	}

	/**
	 * Sets the codeType
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\CodeType $codeType
	 * @return void
	 */
	public function setCodeType(\TEND\ProductCatalog\Domain\Model\CodeType $codeType) {
		$this->codeType = $codeType;
	}

}