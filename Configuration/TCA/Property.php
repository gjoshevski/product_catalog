<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_productcatalog_domain_model_property'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_productcatalog_domain_model_property']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, exclude_from_filtering, type, typeconfig, property_options',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, title, exclude_from_filtering, type, typeconfig, property_options, '),
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
				'foreign_table' => 'tx_productcatalog_domain_model_property',
				'foreign_table_where' => 'AND tx_productcatalog_domain_model_property.pid=###CURRENT_PID### AND tx_productcatalog_domain_model_property.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_property.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'exclude_from_filtering' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_property.exclude_from_filtering',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_property.type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'typeconfig' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_property.typeconfig',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'property_options' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_property.property_options',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_productcatalog_domain_model_propertyoptions',
				'foreign_field' => 'property',
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
		
	),
);
