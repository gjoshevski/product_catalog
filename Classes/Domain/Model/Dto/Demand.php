<?php
namespace TEND\ProductCatalog\Domain\Model\Dto;

/*
 *   Product with all of his properties
 */

class Demand {
		
	/**
	 * @var array
	 */
	protected $categories;
	
	/**
	 * @var string
	 */
	protected $textSearchString;
	
	/**
	 * @var array
	 */
	protected $properties;
	
	/**
	 * @var integer
	 */
	protected $lastNResults;
	
	/**
	 * @var integer
	 */
	protected $offset;	
	

	
	/**
	 * List of allowed categories
	 *
	 * @param array $categories categories
	 * @return void
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * Get allowed categories
	 *
	 * @return array
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**	 
	 *
	 * @param string $textSearchString textSearchString
	 * @return void
	 */
	public function setTextSearchString($textSearchString) {
		$this->textSearchString = $textSearchString;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getTextSearchString() {
		return $this->textSearchString;
	}
	
	/**
	 *
	 * @param array $properties
	 * @return void
	 */
	public function setProperties($properties) {
		$this->properties = $properties;
	}
	
	/**
	 *
	 * @return array $properties
	 */
	public function getProperties() {
		return $this->properties;
	}
	
	
	/**
	 *
	 * @param integer $lastNResults lastNResults
	 * @return void
	 */
	public function setLastNResults($lastNResults) {
		$this->lastNResults = $lastNResults;
	}
	
	/**
	 *
	 * @return integer
	 */
	public function getLastNResults() {
		return $this->lastNResults;
	}
	
	
	/**
	 *
	 * @param integer $offset offset
	 * @return void
	 */
	public function setOffset($offset) {
		$this->offset = $offset;
	}
	
	/**
	 *
	 * @return integer
	 */
	public function getOffset() {
		return $this->offset;
	}
}