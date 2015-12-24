<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_productcatalog_domain_model_productproperty'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_productcatalog_domain_model_productproperty']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, value, property, property_option',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, value, property, property_option, '),
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
				'foreign_table' => 'tx_productcatalog_domain_model_productproperty',
				'foreign_table_where' => 'AND tx_productcatalog_domain_model_productproperty.pid=###CURRENT_PID### AND tx_productcatalog_domain_model_productproperty.sys_language_uid IN (-1,0)',
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

		'value' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productproperty.value',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'property' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productproperty.property',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_productcatalog_domain_model_property',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'property_option' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productproperty.property_option',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_productcatalog_domain_model_propertyoptions',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		
		'product' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
