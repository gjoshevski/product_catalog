<?php
namespace TEND\ProductCatalog\Hooks;

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

 /**
 * DataHandler
 */
class DataHandler{
	public function processDatamap_preProcessFieldArray(array &$fieldsValues, $table, $uid, \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler) {
//\UZ\Catalog\Utility\General::debug($pObj->datamap);exit;
		//if ($table == 'tx_productcatalog_domain_model_product' && is_array($dataHandler->datamap['tt_content'])) {
//$this->debug($fieldsValues);
//$this->debug($dataHandler->datamap);
//$this->debug(count($dataHandler->datamap['tx_productcatalog_domain_model_productproperty']));
		if ($table == 'tx_productcatalog_domain_model_product' && array_key_exists('type', $fieldsValues) && is_array($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'])) {
//$this->debug($dataHandler->datamap);exit;				
			$this->deleteUnusedProductSectionsProperties($dataHandler, $uid, $fieldsValues['type']);
		}
//$this->debug($dataHandler->datamap);exit;
//$this->debug($dataHandler->datamap['tx_productcatalog_domain_model_productproperty']);
		if (is_array($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'])) {
			foreach($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'] as $k => $productproperty) {
				if(array_key_exists('value', $productproperty)) {
					if($productproperty['value']){
						$dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$k]['number_value'] = (float)str_replace(',','',$productproperty['value']);
						//if(strlen($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$k]['number_value'])) {
//$this->debug(strlen($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$k]['number_value']));
//$this->debug($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$k]['number_value']);
						//}
					}else{
						$dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$k]['number_value'] = 0;
					}
					//$dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$k]['number_value'] = number_format(22, 2, '.', '');
				}
			}
		}
//exit;
//$this->debug(count($dataHandler->datamap['tx_productcatalog_domain_model_productproperty']));exit;				
//$this->debug($dataHandler->datamap['tx_productcatalog_domain_model_productproperty']);exit;		
//$this->debug($fieldsValues);
//$this->debug($dataHandler->datamap);exit;
	}
	public function processDatamap_postProcessFieldArray($status, $table, $id, array &$fieldsValues, \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler) {
		/*
		if($status=='new' && is_array($dataHandler->datamap[])) {
		
		}
		*/
	}
	public function processDatamap_afterDatabaseOperations($command, $table, $uid, $fieldsValues, \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler) {
		//Check if product type has been changed
		/*	
		if ($table == 'tx_productcatalog_domain_model_product' && array_key_exists('type', $fieldsValues) && is_array($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'])) {
			$this->deleteUnusedProductSectionsProperties($dataHandler, $uid, $fieldsValues['type']);
		}
		*/
	}
	function deleteUnusedProductSectionsProperties($dataHandler, $productUid, $productType) {
		$unusedSectionsProperties = array();
		if($res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray(array(
			'SELECT' => 'tx_productcatalog_domain_model_productproperty.uid AS product_property,
						tx_productcatalog_section_property_mm.uid_foreign AS property',
			'FROM' => 'tx_productcatalog_section_property_mm
						INNER JOIN tx_productcatalog_producttype_section_mm ON 
							tx_productcatalog_section_property_mm.uid_local=tx_productcatalog_producttype_section_mm.uid_foreign
							AND tx_productcatalog_producttype_section_mm.uid_local != '.$productType.'
							'.$this->getWhereExcludeProductTypeProperties($productType).'
						LEFT JOIN tx_productcatalog_domain_model_productproperty ON 
							tx_productcatalog_section_property_mm.uid_foreign = tx_productcatalog_domain_model_productproperty.property
							AND tx_productcatalog_domain_model_productproperty.product = '.$productUid
		))) {
			while($r = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				if($r['product_property'] && is_array($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$r['product_property']])) {
//$this->debug($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$r['product_property']]);
					unset($dataHandler->datamap['tx_productcatalog_domain_model_productproperty'][$r['product_property']]);
				}
				$unusedSectionsProperties[] = $r['property'];
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
		}
		if(count($unusedSectionsProperties)){
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_productcatalog_domain_model_productproperty', 'product='.$productUid.' AND property IN ('.implode(',',$unusedSectionsProperties).')');	
		}
//$this->debug($unusedSectionsProperties);
//$this->debug($unusedSectionsProperties);exit;
	}

	public function getWhereExcludeProductTypeProperties($productType) {
		$properties = array();
		if($res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray(array(
					'SELECT' => 'tx_productcatalog_section_property_mm.uid_foreign AS property',
					'FROM' => 'tx_productcatalog_section_property_mm
								INNER JOIN tx_productcatalog_producttype_section_mm ON 
									tx_productcatalog_section_property_mm.uid_local=tx_productcatalog_producttype_section_mm.uid_foreign
									AND tx_productcatalog_producttype_section_mm.uid_local = '.$productType,
				))) {
//\OrgTend\Xintranet\Utility\General::debugFile($where);
			while($r = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				$properties[] = $r['property'];
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
		}
		if(count($properties)) {
			return 'AND tx_productcatalog_section_property_mm.uid_foreign NOT IN ('.implode(',',$properties).')';
		}
	}
	/**
	 * Debug to screen
	 *
	 * @param mixed object to debug
	 * @return void
	 */
	public static function debug($o) {
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
?>