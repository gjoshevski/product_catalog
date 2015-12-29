<?php
namespace TEND\ProductCatalog\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Martin Gjoshevski <martin.gjoshevski@tend.si>, org. Tend
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
 * ProductController
 */
class BasicController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	/**
	 * demand
	 *
	 * @var \TEND\ProductCatalog\Domain\Model\Dto\Demand
	 */
	protected $demand = NULL;
	
	/**
	 * sectionRepository
	 *
	 * @var \TEND\ProductCatalog\Domain\Repository\SectionRepository
	 * @inject
	 */
	protected $sectionRepository = NULL;

	/**
	 * productRepository
	 *
	 * @var \TEND\ProductCatalog\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository = NULL;
	
	/**
	 * categoryRepository
	 *
	 * @var \TEND\ProductCatalog\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;
    
     /**
     * @var string
     */
    protected $viewFormatToObjectNameMap = array(
                'html' => 'TYPO3\Fluid\View\TemplateView',
                'json' => 'TYPO3\CMS\Extbase\Mvc\View\JsonView'
    );
    
 
    /**
     * A list of IANA media types which are supported by this controller
     *
     * @var array
     */
    protected $supportedMediaTypes = array('application/json', 'text/html');

    public function initializeView() {   
        if ($this->request->getFormat() === 'json') {
            echo "Json";
            $this->view =  $this->objectManager->create('TYPO3\CMS\Extbase\Mvc\View\JsonView'); 
           $this->view->setControllerContext($this->controllerContext);
        }
    }

    
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->demand = $this->createDemandObjectFromSettings();
	}

	
	public function debug($o){
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($o);
	}
}

