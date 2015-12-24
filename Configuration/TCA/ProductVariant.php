<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_productcatalog_domain_model_productvariant'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_productcatalog_domain_model_productvariant']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, variation, files, images, price, stock, product_code',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, title, variation, files, images, price, stock, product_code, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_productcatalog_domain_model_productvariant',
				'foreign_table_where' => 'AND tx_productcatalog_domain_model_productvariant.pid=###CURRENT_PID### AND tx_productcatalog_domain_model_productvariant.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productvariant.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'variation' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productvariant.variation',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'files' => array(
			'exclude' => 1,
			'label' => 'Files (ex: PDF)',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'files',
				array('maxitems' => 1),
				'*'
			),
		),
		'images' => array(
			'exclude' => 1,
			'label' => 'Images',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array('maxitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productvariant.price',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_productcatalog_domain_model_price',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'stock' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productvariant.stock',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_productcatalog_domain_model_stock',
				'foreign_field' => 'productvariant',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'product_code' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productvariant.product_code',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_productcatalog_domain_model_productcode',
				'foreign_field' => 'productvariant',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		
		'product' => array(
			'exclude' => 1,
			'label' => 'Product',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_productcatalog_domain_model_product',
				'minitems' => 0,
				'maxitems' => 1,
			),
			'displayCond' => 'FIELD:package:=:1'
		),
	),
);
