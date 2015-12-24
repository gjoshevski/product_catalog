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
 * ProductVariant
 */
class ProductVariant extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * variation
	 *
	 * @var string
	 */
	protected $variation = '';

	/**
	 * files
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $files = NULL;

	/**
	 * images
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $images = NULL;

	/**
	 * price
	 *
	 * @var \TEND\ProductCatalog\Domain\Model\Price
	 */
	protected $price = NULL;

	/**
	 * stock
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Stock>
	 * @cascade remove
	 */
	protected $stock = NULL;

	/**
	 * productCode
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductCode>
	 * @cascade remove
	 */
	protected $productCode = NULL;
        
        /**
	 * product
	 *
	 * @var \Tend\ProductCatalog\Domain\Model\Product	 
	 */
	protected $product = NULL;

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
		$this->stock = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->productCode = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the variation
	 *
	 * @return string $variation
	 */
	public function getVariation() {
		return $this->variation;
	}

	/**
	 * Sets the variation
	 *
	 * @param string $variation
	 * @return void
	 */
	public function setVariation($variation) {
		$this->variation = $variation;
	}

	/**
	 * Returns the files
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $files
	 */
	public function getFiles() {
		return $this->files;
	}

	/**
	 * Sets the files
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $files
	 * @return void
	 */
	public function setFiles(\TYPO3\CMS\Extbase\Domain\Model\FileReference $files) {
		$this->files = $files;
	}

	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Domain\Model\FileReference $images) {
		$this->images = $images;
	}

	/**
	 * Returns the price
	 *
	 * @return \TEND\ProductCatalog\Domain\Model\Price $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Price $price
	 * @return void
	 */
	public function setPrice(\TEND\ProductCatalog\Domain\Model\Price $price) {
		$this->price = $price;
	}

	/**
	 * Adds a Stock
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Stock $stock
	 * @return void
	 */
	public function addStock(\TEND\ProductCatalog\Domain\Model\Stock $stock) {
		$this->stock->attach($stock);
	}

	/**
	 * Removes a Stock
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Stock $stockToRemove The Stock to be removed
	 * @return void
	 */
	public function removeStock(\TEND\ProductCatalog\Domain\Model\Stock $stockToRemove) {
		$this->stock->detach($stockToRemove);
	}

	/**
	 * Returns the stock
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Stock> $stock
	 */
	public function getStock() {
		return $this->stock;
	}

	/**
	 * Sets the stock
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Stock> $stock
	 * @return void
	 */
	public function setStock(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $stock) {
		$this->stock = $stock;
	}

	/**
	 * Adds a ProductCode
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductCode $productCode
	 * @return void
	 */
	public function addProductCode(\TEND\ProductCatalog\Domain\Model\ProductCode $productCode) {
		$this->productCode->attach($productCode);
	}

	/**
	 * Removes a ProductCode
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductCode $productCodeToRemove The ProductCode to be removed
	 * @return void
	 */
	public function removeProductCode(\TEND\ProductCatalog\Domain\Model\ProductCode $productCodeToRemove) {
		$this->productCode->detach($productCodeToRemove);
	}

	/**
	 * Returns the productCode
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductCode> $productCode
	 */
	public function getProductCode() {
		return $this->productCode;
	}

	/**
	 * Sets the productCode
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductCode> $productCode
	 * @return void
	 */
	public function setProductCode(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $productCode) {
		$this->productCode = $productCode;
	}        
        
        /**
	 * Returns the product
	 *
	 * @return \Tend\ProductCatalogAuctions\Domain\Model\Product $product
	 */
	public function getProduct() {
		return $this->product;
	}
	
	/**
	 * Sets the product
	 *
	 * @param \Tend\ProductCatalogAuctions\Domain\Model\Product $product
	 * @return void
	 */
	public function setProduct(\Tend\ProductCatalogAuctions\Domain\Model\Product $product) {
		$this->product = $product;
	}

}