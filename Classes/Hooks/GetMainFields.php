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
 * GetMainFields
 */
class GetMainFields {

	/**
	 * @param string $table
	 * @param array $row
	 * @param \TYPO3\CMS\Backend\Form\FormEngine $formEngine
	 */
	public function getMainFields_preProcess($table, $row, \TYPO3\CMS\Backend\Form\FormEngine $formEngine) {
//$this->debug($formEngine->palettesRendered);
		if($table == 'tx_productcatalog_domain_model_product') {
//$this->debug($row);
			$GLOBALS['TCA'][$table]['ctrl']['type'] = 'type';
			$GLOBALS['TCA'][$table]['ctrl']['dividers2tabs'] = 2;
			$GLOBALS['TCA'][$table]['columns']['type']['config']['items'] = array(array('None', 0));
			$GLOBALS['TCA'][$table]['columns']['properties']['config']['eval'] = 'unique';
//$this->debug($row['type']);			
			if($row['type'] > 0) {
				//Save original type fields
				if(!$GLOBALS['dtcaOriginal'][$table][1]) {
					$GLOBALS['dtcaOriginal'][$table][1] = $GLOBALS['TCA'][$table]['types']['1'];
				}
				$GLOBALS['TCA'][$table]['types'][$row['type']] = $GLOBALS['dtcaOriginal'][$table][1];
				$dynamicTabs = array();
				foreach($this->getRecords(array(
					'SELECT' => 'tx_productcatalog_domain_model_section.title, tx_productcatalog_producttype_section_mm.uid_foreign',
					'FROM' => 'tx_productcatalog_domain_model_section
								INNER JOIN tx_productcatalog_producttype_section_mm ON 
									tx_productcatalog_domain_model_section.uid=tx_productcatalog_producttype_section_mm.uid_foreign
									AND tx_productcatalog_domain_model_section.deleted=0
									AND tx_productcatalog_producttype_section_mm.uid_local='.$row['type'],
				)) as $tab) {
					$dynamicTabs[] = '--div--;'.implode('/',explode(',',$tab['title'])).','.$this->getSectionProperties($tab['uid_foreign'], $row);
				}
				$GLOBALS['TCA'][$table]['types'][$row['type']]['showitem'] = preg_replace('/--div--;/', implode(',',$dynamicTabs).'--div--;', $GLOBALS['TCA'][$table]['types'][$row['type']]['showitem'], 1);
			}elseif($GLOBALS['dtcaOriginal'][$table][1]) {
				//Restore original type fields if no type selected	
				$GLOBALS['TCA'][$table]['types']['1'] = $GLOBALS['dtcaOriginal'][$table][1];
			}
		}
		if($table == 'tx_productcatalog_domain_model_productproperty') {
//$this->debug($row);
			//Manipulate additional properties
			if(is_array($formEngine->palettesRendered[$formEngine->renderDepth]['tx_productcatalog_domain_model_productproperty'])) {
				$property = $this->getRecord(array(
					'SELECT' => 'tx_productcatalog_domain_model_property.type, tx_productcatalog_domain_model_property.typeconfig',
					'FROM' => 'tx_productcatalog_domain_model_property',
					'WHERE' => 'tx_productcatalog_domain_model_property.deleted=0 AND tx_productcatalog_domain_model_property.uid='.(int)$row['property']
				));
				$inputConfig = $this->getPropertyInput((int)$row['property'], (int)$property['type'], $property['typeconfig']);
				$GLOBALS['TCA'][$table]['columns'][$inputConfig['input_name']]['config'] = $inputConfig;
				$GLOBALS['TCA'][$table]['ctrl']['type'] = 'property';
				$GLOBALS['TCA'][$table]['ctrl']['label'] = 'property';
				if($row['isInline']) {
					$GLOBALS['TCA'][$table]['columns']['property']['config']['foreign_table_where'] = ' AND tx_productcatalog_domain_model_property.deleted=0 AND tx_productcatalog_domain_model_property.uid IN('.$this->getAvailableAdditionalProperties().')';
					$GLOBALS['TCA'][$table]['types'][1]['showitem'] = 'property, '.$inputConfig['input_name'].', number_value'.(($inputConfig['extra'])?';;;'.$inputConfig['extra']:'');
				}else{
					$GLOBALS['TCA'][$table]['columns']['property']['config']['foreign_table_where'] = ' AND tx_productcatalog_domain_model_property.deleted AND tx_productcatalog_domain_model_property.uid IN('.(int)$row['property'].')';
					$GLOBALS['TCA'][$table]['columns']['product'] = array(
						'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_product',
						'config' => array(
							'type' => 'select',
							'foreign_table' => 'tx_productcatalog_domain_model_product',
							'foreign_table_where' => ' AND tx_productcatalog_domain_model_product.uid IN('.(int)$row['product'].')',
							'minitems' => 1,
							'maxitems' => 1
						)
					);
					$GLOBALS['TCA'][$table]['types'][1]['showitem'] = 'product, property, '.$inputConfig['input_name'].', number_value'.(($inputConfig['extra'])?';;;'.$inputConfig['extra']:'');
				}
			}
		}
		if($table == 'tx_productcatalog_domain_model_property') {
			$GLOBALS['TCA'][$table]['ctrl']['type'] = 'type';
			$GLOBALS['TCA'][$table]['columns']['type']['config'] = array(
				'type' => 'select',
				'items' => array(
					array('Text - Single row', 0),
					array('Text - Multie row', 1),
					array('Text - Rich Text Editor', 2),
					array('Checkbox', 3),
					array('Radio', 4),
					array('Select', 5),
					array('Group', 6),
					array('Date time', 7)
				),
				'minitems' => 0,
				'maxitems' => 1
			);	
		}
	}
	public function getMainFields_postProcess($table, $row, \TYPO3\CMS\Backend\Form\FormEngine $formEngine) {

	}
	public function getSectionProperties($sectionUid, $product) {
		$sectionProperties = array();
		if(is_array($GLOBALS['product_catalog_dtca']) && is_array($GLOBALS['product_catalog_dtca']['section_properties']) && is_array($GLOBALS['product_catalog_dtca']['section_properties'][$product['uid']])) {
			foreach($GLOBALS['product_catalog_dtca']['section_properties'][$product['uid']] as $productProperty) {
				if($productProperty['section'] == $sectionUid) {
					$sectionProperties[] = $this->getDynamicProperty($product, $productProperty);
				}
			}
		}else {
			foreach($this->getRecords(array(
				'SELECT' => 'tx_productcatalog_domain_model_productproperty.uid, 
							tx_productcatalog_domain_model_productproperty.value,
							tx_productcatalog_domain_model_productproperty.property_option,
							tx_productcatalog_domain_model_property.uid AS property,
							tx_productcatalog_section_property_mm.uid_local AS section, 
							tx_productcatalog_domain_model_property.title,
							tx_productcatalog_domain_model_property.type AS property_type,
							tx_productcatalog_domain_model_property.typeconfig AS property_type_config',
				'FROM' => ' tx_productcatalog_domain_model_property
							INNER JOIN tx_productcatalog_section_property_mm ON tx_productcatalog_domain_model_property.uid=tx_productcatalog_section_property_mm.uid_foreign AND tx_productcatalog_domain_model_property.deleted=0
							LEFT JOIN tx_productcatalog_domain_model_productproperty ON tx_productcatalog_domain_model_property.uid=tx_productcatalog_domain_model_productproperty.property AND tx_productcatalog_domain_model_property.deleted=0 AND tx_productcatalog_domain_model_productproperty.product='.$product['uid'].'
							ORDER BY tx_productcatalog_section_property_mm.sorting'
			)) as $productProperty) {
				$GLOBALS['product_catalog_dtca']['section_properties'][$product['uid']][$productProperty['property']] = $productProperty;
				if($productProperty['section'] == $sectionUid) {
					$sectionProperties[] = $this->getDynamicProperty($product, $productProperty); 
				}
			}
		}
//$this->debug($productProperty);
		/*
		$paletteKey = 30+$sectionUid;
		$GLOBALS['TCA']['tx_productcatalog_domain_model_product']['palettes'][$paletteKey] = array(
			'showitem' => implode(',',$sectionProperties), 
			'canNotCollapse' => 1
		);
		return '--palette--;;'.$paletteKey.',';
		*/
//$this->debug($sectionProperties);
		//Set be_user permissions if non admin
		if(!$GLOBALS['BE_USER']->isAdmin()) {
			//\TYPO3\CMS\Core\Utility\GeneralUtility::inList($GLOBALS['BE_USER']->groupData['non_exclude_fields'], 'tx_productcatalog_domain_model_product:properties')
			$GLOBALS['BE_USER']->groupData['non_exclude_fields'] .= ',tx_productcatalog_domain_model_product:'.implode(',tx_productcatalog_domain_model_product:',$sectionProperties);
		}
		return implode(',',$sectionProperties).',';
	}
	public function getDynamicProperty($product, $productProperty) {
		$dynamicProperty = 'section_property_'.$productProperty['property'];		
		$GLOBALS['product_catalog_dtca']['section_properties'][$product['uid']][$productProperty['property']] = $productProperty;
		$GLOBALS['TCA']['tx_productcatalog_domain_model_product']['columns'][$dynamicProperty] = array(
					'exclude' => 1,
					'label' => $productProperty['title'],
					'config' => array(
						'type' => 'text',
						'form_type' => 'user',
						'userFunc' => 'TEND\\ProductCatalog\\User\\TcaProductProperty->input',
						'config' => $this->getPropertyInput($productProperty['property'], (int)$productProperty['property_type'], $productProperty['property_type_config']),
						'row' => array(
							'isInline' => 1,
							'uid' => ($productProperty['uid']?$productProperty['uid']:uniqid('NEW')),
							'pid' => $product['pid'],
							'product' => $product['uid'],
							'property' => $productProperty['property'],
							'value' => $productProperty['value'],
							'property_option' => $productProperty['property_option']
						)
					)
				);
		return $dynamicProperty;	
	}
	public function getPropertyInput($p, $type, $config) {
//$this->debug($type);
		switch ($type) {
			case 0: // 'Text - Single row
				return array(
					'type' => 'input',
					'input_name' => 'value',
					'size' => 30,
					'eval' => 'trim'
				);
				break;
			case 1: // Text - Multie row
				return array(
					'type' => 'text',
					'input_name' => 'value',
					'cols' => 40,
					'rows' => 5,
					'eval' => 'trim'
				);
				break;
			case 2: // Text - Rich Text Editor
				return array(
					'type' => 'text',
					'input_name' => 'value',
					'extra' => 'richtext::rte_transform[flag=rte_disabled|mode=ts_css]',
					//palette' => 0,
					'cols' => '48',
					'rows' => '5',
					'wizards' => array(
						'_PADDING' => 4,
						'_VALIGN' => 'middle',
						'RTE' => array(
							'notNewRecords' => 1,
							'RTEonly' => 1,
							'type' => 'script',
							'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
							'icon' => 'wizard_rte2.gif',
							'script' => 'wizard_rte.php'
						),
						'table' => array(
							'notNewRecords' => 1,
							'enableByTypeConfig' => 1,
							'type' => 'script',
							'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.table',
							'icon' => 'wizard_table.gif',
							'script' => 'wizard_table.php',
							'params' => array(
								'xmlOutput' => 0
							)
						),
						'forms' => array(
							'notNewRecords' => 1,
							'enableByTypeConfig' => 1,
							'type' => 'script',
							'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.forms',
							'icon' => 'wizard_forms.gif',
							'script' => 'wizard_forms.php?special=formtype_mail',
							'params' => array(
								'xmlOutput' => 0
							)
						)
					)
				);
				break;
			case 3: // Checkbox
				return array(
					'type' => 'check',
					'input_name' => 'value',
                	'default' => '0'
				);
				break;
			case 4: // Radio
				return array(
					'type' => 'radio',
					'input_name' => 'property_option',
	                'items' => $this->getPropertyOptions($p)
				);
				break;
			case 5: // Select
				return array(
					'type' => 'select',
					'input_name' => 'property_option',
	                'items' => $this->getPropertyOptions($p)
				);
				break;
			case 6: // Group
				return array(
					'type' => 'group',
					'input_name' => 'property_option',
					'internal_type' => 'db',
					'allowed' => 'pages',
					'size' => 1,
					'filter' => array (
						array(
							'userFunc' => 'EXT:myext/class.tx_myext_filter.php:tx_myext_filter->doFilter',
							'parameters' => array('evaluateGender' => 'female')
						)
					)
				);
				break;
			case 7: // Date time
				return array(
					'type' => 'input',
					'input_name' => 'value',
					'size' => 8,
					'max' => 20,
					'eval' => 'datetime',
					'default' => 0
				);
				break;
			default:
				return array(
					'type' => 'input',
					'input_name' => 'value',
					'size' => 30,
					'eval' => 'trim'
				);
				break;
		}
	}
	public function getPropertyOptions($p) {
		$options = array();	
		foreach($this->getRecords(array(
			'SELECT' => 'uid, title',
			'FROM' => 'tx_productcatalog_domain_model_propertyoptions',
			'WHERE' => 'property='.$p.' AND hidden=0',
		)) as $option) {
			$options[] = array($option['title'], $option['uid']);
		}
		/*
		return array(
			array('LLL:EXT:cms/locallang_tca.xlf:pages.mount_pid_ol.I.0', 0),
			array('LLL:EXT:cms/locallang_tca.xlf:pages.mount_pid_ol.I.1', 1)
		);
		*/
		return $options;
	}

	public function getAvailableAdditionalProperties() {
		if(is_array($GLOBALS['product_catalog_dtca']) && is_array($GLOBALS['product_catalog_dtca']['additional_properties'])) {
			return implode(',',array_keys($GLOBALS['product_catalog_dtca']['additional_properties']));
		}else {
			if($res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray(array(
				'SELECT' => 'tx_productcatalog_domain_model_property.uid, tx_productcatalog_domain_model_property.title',
				'FROM' => 'tx_productcatalog_domain_model_property
							LEFT JOIN tx_productcatalog_section_property_mm ON tx_productcatalog_domain_model_property.uid = tx_productcatalog_section_property_mm.uid_foreign
							 AND tx_productcatalog_domain_model_property.deleted=0',
				'WHERE' => 'tx_productcatalog_section_property_mm.uid_local IS NULL'
			))) {
//\OrgTend\Xintranet\Utility\General::debugFile($where);
				$GLOBALS['product_catalog_dtca']['additional_properties'] = array();
				while($r = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$GLOBALS['product_catalog_dtca']['additional_properties'][$r['uid']] = $r;
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res);
				return implode(',',array_keys($GLOBALS['product_catalog_dtca']['additional_properties']));
			}
		}
		return 0;
	}

	public function getRecord(array $selectConf) {
		$record = array();	
		if($res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray($selectConf)) {
//\OrgTend\Xintranet\Utility\General::debugFile($where);
			$record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
		}
		return $record;
	}

	public function getRecords(array $selectConf) {
		$records = array();
		if($res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray($selectConf)) {
//\OrgTend\Xintranet\Utility\General::debugFile($where);
			while($r = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				$records[] = $r;
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
		}
		return $records;
	}
	
	/**
	 * Debug to screen
	 *
	 * @param mixed object to debug
	 * @return void
	 */
	public function debug($o) {
		/*	
		print_r('<pre>');
		print_r($o);
		print_r('</pre>');
		*/
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($o);
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