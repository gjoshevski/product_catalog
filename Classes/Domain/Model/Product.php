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
 * Product
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * files
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $files = NULL;

	/**
	 * images
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $images = NULL;

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * type
	 *
	 * @var \TEND\ProductCatalog\Domain\Model\ProductType
	 * @lazy
	 */
	protected $type = NULL;

	/**
	 * properties
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductProperty>
	 * @cascade remove
	 */
	protected $properties = NULL;

	/**
	 * categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Category>
	 */
	protected $categories = NULL;

	/**
	 * relatedProducts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Product>
	 * @lazy
	 */
	protected $relatedProducts = NULL;

	/**
	 * variants
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductVariant>
	 * @cascade remove	
	 */
	protected $variants = NULL;

	/**
	 * packageProducts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Product>
	 * @lazy
	 */
	protected $packageProducts = NULL;

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
		$this->files = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->properties = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->relatedProducts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->variants = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->packageProducts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
	 * @return void
	 */
	public function addFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $file) {
		$this->files->attach($file);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $fileToRemove) {
		$this->files->detach($fileToRemove);
	}

	/**
	 * Returns the files
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
	 */
	public function getFiles() {
		return $this->files;
	}

	/**
	 * Sets the files
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
	 * @return void
	 */
	public function setFiles(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $files) {
		$this->files = $files;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->images->attach($image);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove) {
		$this->images->detach($imageToRemove);
	}

	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images) {
		$this->images = $images;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the type
	 *
	 * @return \TEND\ProductCatalog\Domain\Model\ProductType $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductType $type
	 * @return void
	 */
	public function setType(\TEND\ProductCatalog\Domain\Model\ProductType $type) {
		$this->type = $type;
	}

	/**
	 * Adds a ProductProperty
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductProperty $property
	 * @return void
	 */
	public function addProperty(\TEND\ProductCatalog\Domain\Model\ProductProperty $property) {
		$this->properties->attach($property);
	}

	/**
	 * Removes a ProductProperty
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductProperty $propertyToRemove The ProductProperty to be removed
	 * @return void
	 */
	public function removeProperty(\TEND\ProductCatalog\Domain\Model\ProductProperty $propertyToRemove) {
		$this->properties->detach($propertyToRemove);
	}

	/**
	 * Returns the properties
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductProperty> $properties
	 */
	public function getProperties() {
		return $this->properties;
	}

	/**
	 * Sets the properties
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductProperty> $properties
	 * @return void
	 */
	public function setProperties(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $properties) {
		$this->properties = $properties;
	}

	/**
	 * Adds a Category
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\TEND\ProductCatalog\Domain\Model\Category $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\TEND\ProductCatalog\Domain\Model\Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Category> $categories
	 * @return void
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories) {
		$this->categories = $categories;
	}

	/**
	 * Adds a Product
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Product $relatedProduct
	 * @return void
	 */
	public function addRelatedProduct(\TEND\ProductCatalog\Domain\Model\Product $relatedProduct) {
		$this->relatedProducts->attach($relatedProduct);
	}

	/**
	 * Removes a Product
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Product $relatedProductToRemove The Product to be removed
	 * @return void
	 */
	public function removeRelatedProduct(\TEND\ProductCatalog\Domain\Model\Product $relatedProductToRemove) {
		$this->relatedProducts->detach($relatedProductToRemove);
	}

	/**
	 * Returns the relatedProducts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Product> $relatedProducts
	 */
	public function getRelatedProducts() {
		return $this->relatedProducts;
	}

	/**
	 * Sets the relatedProducts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Product> $relatedProducts
	 * @return void
	 */
	public function setRelatedProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedProducts) {
		$this->relatedProducts = $relatedProducts;
	}

	/**
	 * Adds a ProductVariant
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductVariant $variant
	 * @return void
	 */
	public function addVariant(\TEND\ProductCatalog\Domain\Model\ProductVariant $variant) {
		$this->variants->attach($variant);
	}

	/**
	 * Removes a ProductVariant
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\ProductVariant $variantToRemove The ProductVariant to be removed
	 * @return void
	 */
	public function removeVariant(\TEND\ProductCatalog\Domain\Model\ProductVariant $variantToRemove) {
		$this->variants->detach($variantToRemove);
	}

	/**
	 * Returns the variants
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductVariant> $variants
	 */
	public function getVariants() {
		return $this->variants;
	}

	/**
	 * Sets the variants
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\ProductVariant> $variants
	 * @return void
	 */
	public function setVariants(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $variants) {
		$this->variants = $variants;
	}

	/**
	 * Adds a Product
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Product $packageProduct
	 * @return void
	 */
	public function addPackageProduct(\TEND\ProductCatalog\Domain\Model\Product $packageProduct) {
		$this->packageProducts->attach($packageProduct);
	}

	/**
	 * Removes a Product
	 *
	 * @param \TEND\ProductCatalog\Domain\Model\Product $packageProductToRemove The Product to be removed
	 * @return void
	 */
	public function removePackageProduct(\TEND\ProductCatalog\Domain\Model\Product $packageProductToRemove) {
		$this->packageProducts->detach($packageProductToRemove);
	}

	/**
	 * Returns the packageProducts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Product> $packageProducts
	 */
	public function getPackageProducts() {
		return $this->packageProducts;
	}

	/**
	 * Sets the packageProducts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TEND\ProductCatalog\Domain\Model\Product> $packageProducts
	 * @return void
	 */
	public function setPackageProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $packageProducts) {
		$this->packageProducts = $packageProducts;
	}

}