<?php
namespace TEND\ProductCatalog\Domain\Repository;


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
 * The repository for Products
 */
class ProductRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {


	
	/**
	 * @param \TEND\ProductCatalog\Domain\Model\Dto\Demand $demand
	 */
	public function findByDemand(\TEND\ProductCatalog\Domain\Model\Dto\Demand $demand) {
		$query = $this->createQuery ();
	
		// Setting filterfields and search field
	
		$filterFields = $demand->getProperties();
		if (empty ( $filterFields )) {
			$filterFields = null;
		}
	
		$textSearchString = $demand->getTextSearchString ();
		if (empty ( $textSearchString )) {
			$textSearchString = '';
		}
	
		// --- ! -----
	
		// Search only by Filters
		if ($filterFields != null && $textSearchString == '') {
			$query = $this->findByFilters($query,$demand->getProperties());
		} else {
			// Search by filters and string
			if ($filterFields != null && $textSearchString != '') {
				$query = $this->findByFiltersAndSearchString( $query, $demand->getProperties(), $demand->getTextSearchString () );
			} else {
				// Search by string
				if ($filterFields == null && $textSearchString != '') {
					$query = $this->findBySearchString ( $query, $demand->getTextSearchString () );
				} else {
					// filter by category
					if ($demand->getCategories () != null) {
						$query = $this->findByCategory ( $query, $demand->getCategories () );
					}
				}
			}
		}
		
		if($demand->getLastNResults()!= null && $demand->getLastNResults()!= ''){			
			$query->setLimit((integer)$demand->getLastNResults());
			$query->setOrderings(array('tstamp' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		}
	
		/*
			$parser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Storage\\Typo3DbQueryParser');
		$params = array();
		$queryParts = $parser->parseQuery($query);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParts);
		*/
		
		$resultsFromQuery = $query->execute();
					
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['product_catalog']['filterProducts'])) {
			
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['product_catalog']['filterProducts'] as $_classRef) {				
				$_procObj = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj($_classRef);				
				$resultsFromQuery =	$_procObj->filterProducts($resultsFromQuery, $this);
			}
		}
	
	
		return $resultsFromQuery;
	}
	
	


	/**
	 * @param $query
	 * @param $categoryesArray
	 */
	public function findByCategory($query, $categories) {
		if (! is_array ( $categories )) {
			$categories = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode ( ',', $categories, TRUE );
		}
		
		$constrains = array ();
		
		foreach ( $categories as $category ) {
			
			$subCategories = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode ( ',', \TEND\ProductCatalog\Utility\CategoryService::getChildrenCategories ( $category, 0, '', TRUE ), TRUE );
			$subCategories [] = $category;
			$constrains [] = $query->in ( 'categories.uid', $subCategories );
		}
		
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($subCategories);
		
		$query->matching ( $query->logicalOr ( $constrains ) );
		
		return $query;
	}	
	
	

	/**
	 * @param $query
	 * @param $filterArr
	 */
	public function findByFilters($query, $filterArr) {
		$filterArr = array_filter ( $filterArr );
		// $GLOBALS['TYPO3_DB']->debugOutput = 2;
		$query = $this->createQuery ();
		$arrAllPropOptionsIds = array ();
		foreach ( $filterArr as $fa ) {
			if (is_array ( $fa )) {
				$arrAllPropOptionsIds = array_merge ( $arrAllPropOptionsIds, $fa );
			} else {
				$arrAllPropOptionsIds [] = ( int ) $fa;
			}
		}
		$query->statement ( 'SELECT * FROM tx_productcatalog_domain_model_product 
							LEFT JOIN tx_productcatalog_domain_model_productproperty ON tx_productcatalog_domain_model_product.uid=tx_productcatalog_domain_model_productproperty.product 
							WHERE tx_productcatalog_domain_model_productproperty.property_option IN (' . implode ( ', ', $arrAllPropOptionsIds ) . ') 
							AND (tx_productcatalog_domain_model_product.sys_language_uid IN (0,-1)) 
							AND tx_productcatalog_domain_model_product.pid IN (24) 
							AND (tx_productcatalog_domain_model_productproperty.sys_language_uid IN (0,-1)) 
							AND tx_productcatalog_domain_model_productproperty.pid IN (24) 
							AND tx_productcatalog_domain_model_product.t3ver_state<=0 
							AND tx_productcatalog_domain_model_product.pid<>-1 
							AND tx_productcatalog_domain_model_product.hidden=0 
							AND tx_productcatalog_domain_model_product.starttime<=1403253060 
							AND (tx_productcatalog_domain_model_product.endtime=0 OR tx_productcatalog_domain_model_product.endtime>1403253060) 
							AND tx_productcatalog_domain_model_productproperty.t3ver_state<=0 
							AND tx_productcatalog_domain_model_productproperty.pid<>-1
							group by tx_productcatalog_domain_model_product.uid
  							having count(tx_productcatalog_domain_model_product.uid) ="' . count ( $filterArr ) . '"' );
		/*
		 * $parser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Storage\\Typo3DbQueryParser'); $params = array(); $queryParts = $parser->parseQuery($query); \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $queryParts );
		 */
		
		return $query;
	}

	/**
	 * @param $query
	 * @param $searchtext
	 */
	public function findBySearchString($query, $searchtext) {
		$searchtext = '%' . $searchtext . '%';
		$query->matching($query->like('properties.value', $searchtext));
		$query->matching($query->like('title', $searchtext));
		return $query;
	}

	/**
	 * @param $query
	 * @param $filterArr
	 * @param $searhcString
	 */
	public function findByFiltersAndSearchString($query, $filterArr, $searhcString) {
		// TODO: FILTER NOT COMPLITED // Wrong logic
		$filterArr = array_filter ( $filterArr );
		$arrAllPropOptionsIds = array ();
		foreach ( $filterArr as $fa ) {
			if (is_array ( $fa )) {
				$arrAllPropOptionsIds = array_merge ( $arrAllPropOptionsIds, $fa );
			} else {
				$arrAllPropOptionsIds [] = ( int ) $fa;
			}
		}
		$numOfPropToBeFiltered = count ( $filterArr );
		$srcQuerr = 'SELECT * FROM tx_productcatalog_domain_model_product
							LEFT JOIN tx_productcatalog_domain_model_productproperty ON tx_productcatalog_domain_model_product.uid=tx_productcatalog_domain_model_productproperty.product
							WHERE';
		if ($numOfPropToBeFiltered > 0) {
			$srcQuerr .= ' tx_productcatalog_domain_model_productproperty.property_option IN (' . implode ( ', ', $arrAllPropOptionsIds ) . ')';
			if (! empty ( $searhcString )) {
				$srcQuerr .= ' OR (tx_productcatalog_domain_model_productproperty.value  LIKE  \'%' . $searhcString . '%\')';
			} else {
				$numOfPropToBeFiltered --;
			}
		} else {
			if (! empty ( $searhcString )) {
				$srcQuerr .= ' tx_productcatalog_domain_model_productproperty.value  LIKE  \'%' . $searhcString . '%\'';
				$numOfPropToBeFiltered = 0;
			}
		}
		$srcQuerr .= ' AND (tx_productcatalog_domain_model_product.sys_language_uid IN (0,-1))
			AND tx_productcatalog_domain_model_product.pid IN (24)
			AND (tx_productcatalog_domain_model_productproperty.sys_language_uid IN (0,-1))
			AND tx_productcatalog_domain_model_productproperty.pid IN (24)
			AND tx_productcatalog_domain_model_product.t3ver_state<=0
			AND tx_productcatalog_domain_model_product.pid<>-1
			AND tx_productcatalog_domain_model_product.hidden=0
			AND tx_productcatalog_domain_model_product.starttime<=1403253060
			AND (tx_productcatalog_domain_model_product.endtime=0 OR tx_productcatalog_domain_model_product.endtime>1403253060)
			AND tx_productcatalog_domain_model_productproperty.t3ver_state<=0
			AND tx_productcatalog_domain_model_productproperty.pid<>-1
			group by tx_productcatalog_domain_model_product.uid
			having count(tx_productcatalog_domain_model_product.uid) > \'' . $numOfPropToBeFiltered . '\'';
		// TODO: COUNT IS NOT GOOD SOLUTION ->
		$query->statement ( $srcQuerr );
		// $results = $query->execute();
		return $query;
	}

	

}