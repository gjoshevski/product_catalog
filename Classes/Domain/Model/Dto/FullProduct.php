<?php
namespace TEND\ProductCatalog\Domain\Model\Dto;

/*
 *   Product with all of his properties
 */

class FullProduct extends TEND\ProductCatalog\Domain\Model\Product {
	
	
	protected $propertiesArray;
	
	
	
	/**
	 * Returns the properties
	 *
	 * @return array
	 */
	public function getProperties() {
		return $this->propertiesArray;
	}
	
	/**
	 * Sets the propertiesArray
	 *
	 * @param array
	 * @return  array
	 */
	public function setProperties(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $propertiesArray) {
		$this->propertiesArray = $propertiesArray;
	}
	
}