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
 * Section
 */
class Section extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * allowFiltering
	 *
	 * @var boolean
	 */
	protected $allowFiltering = FALSE;

	/**
	 * properties
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Property>
	 */
	protected $properties = NULL;

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
		$this->properties = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the allowFiltering
	 *
	 * @return boolean $allowFiltering
	 */
	public function getAllowFiltering() {
		return $this->allowFiltering;
	}

	/**
	 * Sets the allowFiltering
	 *
	 * @param boolean $allowFiltering
	 * @return void
	 */
	public function setAllowFiltering($allowFiltering) {
		$this->allowFiltering = $allowFiltering;
	}

	/**
	 * Returns the boolean state of allowFiltering
	 *
	 * @return boolean
	 */
	public function isAllowFiltering() {
		return $this->allowFiltering;
	}

	/**
	 * Adds a Property
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Property $property
	 * @return void
	 */
	public function addProperty(\TEND\ProductCatalog\Domain\Model\Property $property) {
		$this->properties->attach($property);
	}

	/**
	 * Removes a Property
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Property $propertyToRemove The Property to be removed
	 * @return void
	 */
	public function removeProperty(\TEND\ProductCatalog\Domain\Model\Property $propertyToRemove) {
		$this->properties->detach($propertyToRemove);
	}

	/**
	 * Returns the properties
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Property> $properties
	 */
	public function getProperties() {
		return $this->properties;
	}

	/**
	 * Sets the properties
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Property> $properties
	 * @return void
	 */
	public function setProperties(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $properties) {
		$this->properties = $properties;
	}

}