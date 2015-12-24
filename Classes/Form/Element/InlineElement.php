<?php
namespace TEND\ProductCatalog\Form\Element;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Uroš Žunko
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
 
 
class InlineElement extends \TYPO3\CMS\Backend\Form\Element\InlineElement {
	
	/**
	 * Wrapper for TCEforms::getMainFields().
	 *
	 * @param string $table The table name
	 * @param array $row The record to be rendered
	 * @param array $overruleTypesArray Overrule TCA [types] array, e.g to overrride [showitem] configuration of a particular type
	 * @return string The rendered form
	 */
	protected function renderMainFields($table, array $row, array $overruleTypesArray = array()) {
		/*	
		if($table == 'tx_productcatalog_domain_model_productproperty') {
//$this->debug($parent['uid']);			
			$parent = $this->getStructureLevel(0);	
			if($parent['table'] == 'tx_productcatalog_domain_model_product' && $parent['field'] == 'properties') {
//$this->debug($parent['uid']);
				if(is_array($GLOBALS['product_catalog_dtca']) && is_array($GLOBALS['product_catalog_dtca'][$parent['uid']]) && is_array($GLOBALS['product_catalog_dtca'][$parent['uid']]['section_properties'])) {
					$foreignTableWhere = $GLOBALS['TCA'][$table]['columns']['property']['config']['foreign_table_where'];
					$GLOBALS['TCA'][$table]['columns']['property']['config']['foreign_table_where'] = ' AND tx_productcatalog_domain_model_property.uid NOT IN('.implode(',',array_keys($GLOBALS['product_catalog_dtca'][$parent['uid']]['section_properties'])).')';
					$renderedMainFields = parent::renderMainFields($table, $row, $overruleTypesArray);
					$GLOBALS['TCA'][$table]['columns']['property']['config']['foreign_table_where'] = $foreignTableWhere;
					return $renderedMainFields;	
				}
			}
		}
		*/
		return parent::renderMainFields($table, $row, $overruleTypesArray);
	}
	
	function debug($o) {
		print_r('<pre>');
		print_r($o);
		print_r('</pre>');
	}
}
?>