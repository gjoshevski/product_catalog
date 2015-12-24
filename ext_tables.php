<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Catalogbasic',
	'Catalog '
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_catalogbasic';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_catalogbasic.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Catalog');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_product', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_product.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_product');
$GLOBALS['TCA']['tx_productcatalog_domain_model_product'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_product',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,files,images,description,type,properties,categories,related_products,variants,package_products,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Product.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_product.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_producttype', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_producttype.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_producttype');
$GLOBALS['TCA']['tx_productcatalog_domain_model_producttype'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_producttype',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(

		),
		'searchFields' => 'title,sections,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/ProductType.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_producttype.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_section', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_section.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_section');
$GLOBALS['TCA']['tx_productcatalog_domain_model_section'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_section',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(

		),
		'searchFields' => 'title,allow_filtering,properties,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Section.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_section.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_property', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_property.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_property');
$GLOBALS['TCA']['tx_productcatalog_domain_model_property'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_property',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(

		),
		'searchFields' => 'title,exclude_from_filtering,type,typeconfig,property_options,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Property.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_property.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_propertyoptions', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_propertyoptions.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_propertyoptions');
$GLOBALS['TCA']['tx_productcatalog_domain_model_propertyoptions'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_propertyoptions',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'title,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/PropertyOptions.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_propertyoptions.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_productproperty', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_productproperty.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_productproperty');
$GLOBALS['TCA']['tx_productcatalog_domain_model_productproperty'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productproperty',
		'label' => 'value',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'enablecolumns' => array(

		),
		'searchFields' => 'value,property,property_option,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/ProductProperty.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_productproperty.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_productvariant', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_productvariant.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_productvariant');
$GLOBALS['TCA']['tx_productcatalog_domain_model_productvariant'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productvariant',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'enablecolumns' => array(

		),
		'searchFields' => 'title,variation,price,stock,product_code,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/ProductVariant.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_productvariant.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_price', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_price.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_price');
$GLOBALS['TCA']['tx_productcatalog_domain_model_price'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_price',
		'label' => 'price',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'enablecolumns' => array(

		),
		'searchFields' => 'price,discount_price,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Price.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_price.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_stock', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_stock.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_stock');
$GLOBALS['TCA']['tx_productcatalog_domain_model_stock'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_stock',
		'label' => 'stock_value',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'enablecolumns' => array(

		),
		'searchFields' => 'stock_value,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Stock.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_stock.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_productcode', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_productcode.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_productcode');
$GLOBALS['TCA']['tx_productcatalog_domain_model_productcode'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_productcode',
		'label' => 'code',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'enablecolumns' => array(

		),
		'searchFields' => 'code,code_type,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/ProductCode.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_productcode.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productcatalog_domain_model_codetype', 'EXT:product_catalog/Resources/Private/Language/locallang_csh_tx_productcatalog_domain_model_codetype.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productcatalog_domain_model_codetype');
$GLOBALS['TCA']['tx_productcatalog_domain_model_codetype'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_codetype',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/CodeType.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_productcatalog_domain_model_codetype.gif'
	),
);

if (!isset($GLOBALS['TCA']['sys_category']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['sys_category']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['sys_category']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['sys_category']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$GLOBALS['TCA']['sys_category']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('Default','1')
			),
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $tempColumns, 1);
}

$GLOBALS['TCA']['sys_category']['types']['Tx_ProductCatalog_Category']['showitem'] = $TCA['sys_category']['types']['1']['showitem'];
$GLOBALS['TCA']['sys_category']['types']['Tx_ProductCatalog_Category']['showitem'] .= ',--div--;LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:tx_productcatalog_domain_model_category,';
$GLOBALS['TCA']['sys_category']['types']['Tx_ProductCatalog_Category']['showitem'] .= '';

$GLOBALS['TCA']['sys_category']['columns'][$TCA['sys_category']['ctrl']['type']]['config']['items'][] = array(
	'LLL:EXT:product_catalog/Resources/Private/Language/locallang_db.xlf:sys_category.tx_extbase_type.Tx_ProductCatalog_Category',
	'Tx_ProductCatalog_Category'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
	'sys_category',
	'EXT:product_catalog/Resources/Private/Language/locallang_csh_sys_category.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'sys_category',
	$GLOBALS['TCA']['sys_category']['ctrl']['type'],
	'',
	'after:' . $TCA['sys_category']['ctrl']['label']
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    $_EXTKEY,
    'tx_productcatalog_domain_model_product'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Product Catalog DTCA');