<?php
namespace TEND\ProductCatalog\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
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
 * The repository for ProductProperties
 */
class ProductPropertyRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	
	
	public function findByFilters($filterArr) {
		
		
	
		
	//	$GLOBALS['TYPO3_DB']->debugOutput = 2;
			$query = $this->createQuery();
						
			
			$constraintsLevel2 = array();
			
			foreach ($filterArr as $key => $subArr){

				$constraintsLevel1 = array();
				
				if(!is_array ($subArr)){
					continue;
				}
				
				foreach ($subArr as $val){
				
					$constraintsLevel1[] =$query->logicalAnd($query->equals('property', $key), $query->equals('value', $val));					
				}
				
				$constraintsLevel2[] = $query->logicalOr($constraintsLevel1);
				
			}
			
			$query->matching($query->logicalOr($constraintsLevel2));	

			$parser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Storage\\Typo3DbQueryParser');
			$params = array();
			$queryParts = $parser->parseQuery($query);
			
			// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $queryParts );
			
			
			
			$results = $query->execute();
			
			
			
			return $results;
		}

	
}