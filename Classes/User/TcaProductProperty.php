<?php
namespace TEND\ProductCatalog\User;

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
 
 
class TcaProductProperty extends \TYPO3\CMS\Backend\Form\FormEngine {
	/*	
	public function label($PA, $formEngine) {

	}
	*/
	public function input($PA, $formEngine) {
//$this->debug($PA);exit;
//$this->debug($formEngine->fieldTemplate);exit;
		$GLOBALS['TCA']['tx_productcatalog_domain_model_productproperty']['columns'][$PA['fieldConf']['config']['config']['input_name']] =  array(
						'exclude' => 1,
						'config' => $PA['fieldConf']['config']['config']
					);
//$this->debug($PA['fieldConf']['config']['config']['input_name']);
		return $formEngine->getSingleField('tx_productcatalog_domain_model_productproperty', $PA['fieldConf']['config']['config']['input_name'], $PA['fieldConf']['config']['row'], '', $PA['fieldConf']['config']['config']['palette'], $PA['fieldConf']['config']['config']['extra']);
	}
	function debug($o) {
		print_r('<pre>');
		print_r($o);
		print_r('</pre>');
	}
}
?>