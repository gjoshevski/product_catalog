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
 * Variant
 */
class Variant extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * property
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductProperty>
	 * @cascade remove
	 */
	protected $property = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->property = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a ProductProperty
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductProperty $property
	 * @return void
	 */
	public function addProperty(\TEND\ProductCatalog\Domain\Model\ProductProperty $property) {
		$this->property->attach($property);
	}

	/**
	 * Removes a ProductProperty
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductProperty $propertyToRemove The ProductProperty to be removed
	 * @return void
	 */
	public function removeProperty(\TEND\ProductCatalog\Domain\Model\ProductProperty $propertyToRemove) {
		$this->property->detach($propertyToRemove);
	}

	/**
	 * Returns the property
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductProperty> $property
	 */
	public function getProperty() {
		return $this->property;
	}

	/**
	 * Sets the property
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductProperty> $property
	 * @return void
	 */
	public function setProperty(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $property) {
		$this->property = $property;
	}

}