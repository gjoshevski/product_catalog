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
 * Price
 */
class Price extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * price
	 *
	 * @var float
	 */
	protected $price = 0.0;

	/**
	 * discountPrice
	 *
	 * @var string
	 */
	protected $discountPrice = '';

	/**
	 * onDiscount
	 *
	 * @var boolean
	 */
	protected $onDiscount = FALSE;

	/**
	 * Returns the price
	 *
	 * @return float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the discountPrice
	 *
	 * @return string $discountPrice
	 */
	public function getDiscountPrice() {
		return $this->discountPrice;
	}

	/**
	 * Sets the discountPrice
	 *
	 * @param string $discountPrice
	 * @return void
	 */
	public function setDiscountPrice($discountPrice) {
		$this->discountPrice = $discountPrice;
	}

	/**
	 * Returns the onDiscount
	 *
	 * @return boolean $onDiscount
	 */
	public function getOnDiscount() {
		return $this->onDiscount;
	}

	/**
	 * Sets the onDiscount
	 *
	 * @param boolean $onDiscount
	 * @return void
	 */
	public function setOnDiscount($onDiscount) {
		$this->onDiscount = $onDiscount;
	}

	/**
	 * Returns the boolean state of onDiscount
	 *
	 * @return boolean
	 */
	public function isOnDiscount() {
		return $this->onDiscount;
	}

}