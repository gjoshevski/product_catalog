<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_productcatalog_domain_model_section'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_productcatalog_domain_model_section']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, allow_filtering, properties',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, title, allow_filtering, properties, '),
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
				'foreign_table' => 'tx_productcatalog_domain_model_section',
				'foreign_table_where' => 'AND tx_productcatalog_domain_model_section.pid=###CURRENT_PID### AND tx_productcatalog_domain_model_section.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_section.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'allow_filtering' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_section.allow_filtering',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'properties' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_section.properties',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_productcatalog_domain_model_property',
				'MM' => 'tx_productcatalog_section_property_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_productcatalog_domain_model_property',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		
	),
);
