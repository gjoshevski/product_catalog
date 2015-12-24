<?php
namespace TEND\ProductCatalog\Hooks;

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
 * GetSingleField
 */
class GetSingleField {
	var $fieldTemplate; 
	public function getSingleField_preProcess($table, $field, &$row, $altName, $palette, $extra, $pal, \TYPO3\CMS\Backend\Form\FormEngine $formEngine) {
//$this->debug($formEngine->fieldTemplate);exit;
//$this->debug($field);
		if($table == 'tx_productcatalog_domain_model_productproperty') {
			if($row['isInline']) {
				//Save original template
				$this->fieldTemplate = $formEngine->fieldTemplate;
				//Custom template
				$formEngine->fieldTemplate = '###FIELD_ITEM_NULLVALUE### ###FIELD_ITEM###';
			}
		}
		if($table == 'tx_productcatalog_domain_model_product' && $field == 'properties' && $row['type'] && \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($row['uid'])) {
			$row['properties'] = $this->excludeSectionsProperties($row);
		}
	}
	public function getSingleField_postProcess($table, $field, $row, &$out, $PA, \TYPO3\CMS\Backend\Form\FormEngine $formEngine) {
		if($table == 'tx_productcatalog_domain_model_productproperty') {
			if($row['isInline']) {
				//Restore template
				$formEngine->fieldTemplate = $this->fieldTemplate;
				$out .= '<input type="hidden" name="data[' . $table . '][' . $row['uid'] . '][pid]" value="' . $row['pid'] . '"/>';
				$out .= '<input type="hidden" name="data[' . $table . '][' . $row['uid'] . '][product]" value="' . $row['product'] . '"/>';
				$out .= '<input type="hidden" name="data[' . $table . '][' . $row['uid'] . '][property]" value="' . $row['property'] . '"/>';
				if($field == 'value') {		
					$out .= '<input type="hidden" name="data[' . $table . '][' . $row['uid'] . '][property_option]" value="0"/>';
				}else {
					$out .= '<input type="hidden" name="data[' . $table . '][' . $row['uid'] . '][value]" value=""/>';
				}
				$out .= '<input type="hidden" name="data[' . $table . '][' . $row['uid'] . '][number_value]" value="' . $row['number_value'] . '"/>';
			}
		}
	}
	
	public function excludeSectionsProperties($product) {
		$productAdditionalProperties = array();
		if($res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray(array(
			'SELECT' => 'tx_productcatalog_domain_model_productproperty.uid',
			'FROM' => 'tx_productcatalog_domain_model_productproperty
						LEFT JOIN tx_productcatalog_section_property_mm ON 
							tx_productcatalog_domain_model_productproperty.product = '.$product['uid'].'
							AND tx_productcatalog_domain_model_productproperty.property=tx_productcatalog_section_property_mm.uid_foreign',
			'WHERE' => 'tx_productcatalog_section_property_mm.uid_foreign IS NULL AND tx_productcatalog_domain_model_productproperty.product='.$product['uid'],			
		))) {
			while($productProperty = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				$productAdditionalProperties[] = $productProperty['uid'];
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
		}
		return implode(',',$productAdditionalProperties);
	}
	
	/**
	 * Debug to screen
	 *
	 * @param mixed object to debug
	 * @return void
	 */
	public function debug($o) {
		print_r('<pre>');
		print_r($o);
		print_r('</pre>');
	}
	
	/**
	 * Debug to file
	 *
	 * @param mixed object to print
	 * @return void
	 */
	public function debugFile($o, $clear = FALSE) {
		if($clear === TRUE) {
			file_put_contents(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('xintranet').'debug_'.$GLOBALS['BE_USER']->user['uid'].'_'.date("Y_m_d").'.txt', $o.chr(10));	
		}else{
			file_put_contents(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('xintranet').'debug_'.$GLOBALS['BE_USER']->user['uid'].'_'.date("Y_m_d").'.txt', $o.chr(10),FILE_APPEND);	
		}
	}
}