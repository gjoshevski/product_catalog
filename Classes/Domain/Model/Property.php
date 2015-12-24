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
 * Property
 */
class Property extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * excludeFromFiltering
	 *
	 * @var boolean
	 */
	protected $excludeFromFiltering = FALSE;

	/**
	 * type
	 *
	 * @var string
	 */
	protected $type = '';

	/**
	 * typeconfig
	 *
	 * @var string
	 */
	protected $typeconfig = '';

	/**
	 * propertyOptions
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\PropertyOptions>
	 * @cascade remove
	 */
	protected $propertyOptions = NULL;

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
		$this->propertyOptions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the excludeFromFiltering
	 *
	 * @return boolean $excludeFromFiltering
	 */
	public function getExcludeFromFiltering() {
		return $this->excludeFromFiltering;
	}

	/**
	 * Sets the excludeFromFiltering
	 *
	 * @param boolean $excludeFromFiltering
	 * @return void
	 */
	public function setExcludeFromFiltering($excludeFromFiltering) {
		$this->excludeFromFiltering = $excludeFromFiltering;
	}

	/**
	 * Returns the boolean state of excludeFromFiltering
	 *
	 * @return boolean
	 */
	public function isExcludeFromFiltering() {
		return $this->excludeFromFiltering;
	}

	/**
	 * Returns the type
	 *
	 * @return string $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the typeconfig
	 *
	 * @return string $typeconfig
	 */
	public function getTypeconfig() {
		return $this->typeconfig;
	}

	/**
	 * Sets the typeconfig
	 *
	 * @param string $typeconfig
	 * @return void
	 */
	public function setTypeconfig($typeconfig) {
		$this->typeconfig = $typeconfig;
	}

	/**
	 * Adds a PropertyOptions
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\PropertyOptions $propertyOption
	 * @return void
	 */
	public function addPropertyOption(\TEND\ProductCatalog\Domain\Model\PropertyOptions $propertyOption) {
		$this->propertyOptions->attach($propertyOption);
	}

	/**
	 * Removes a PropertyOptions
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\PropertyOptions $propertyOptionToRemove The PropertyOptions to be removed
	 * @return void
	 */
	public function removePropertyOption(\TEND\ProductCatalog\Domain\Model\PropertyOptions $propertyOptionToRemove) {
		$this->propertyOptions->detach($propertyOptionToRemove);
	}

	/**
	 * Returns the propertyOptions
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\PropertyOptions> $propertyOptions
	 */
	public function getPropertyOptions() {
		return $this->propertyOptions;
	}

	/**
	 * Sets the propertyOptions
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\PropertyOptions> $propertyOptions
	 * @return void
	 */
	public function setPropertyOptions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $propertyOptions) {
		$this->propertyOptions = $propertyOptions;
	}

}