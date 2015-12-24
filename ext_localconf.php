<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TEND.' . $_EXTKEY,
	'Catalogbasic',
	array(
		'Product' => 'list, show, filterForm',
		'Category' => 'list'
	),
	// non-cacheable actions
	array(
	)
);
if(TYPO3_MODE == 'BE') {
	$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] = 'TEND\\ProductCatalog\\Hooks\\DataHandler';
	$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getMainFieldsClass'][$_EXTKEY] = 'TEND\\ProductCatalog\\Hooks\\GetMainFields';
	$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getSingleFieldClass'][$_EXTKEY] = 'TEND\\ProductCatalog\\Hooks\\GetSingleField';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\Form\\Element\\InlineElement'] = array('className' => 'TEND\\ProductCatalog\\Form\\Element\\InlineElement');
}