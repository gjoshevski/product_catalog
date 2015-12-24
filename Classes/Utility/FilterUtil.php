<?php
namespace TEND\ProductCatalog\Utility;

class FilterUtil{
	
	
	public function separeteArrayElementsWithKeyLike($needle, array $haystack){
		
		$trimedArray = array();
		
		foreach ($haystack as $key => $hay){			
			if( substr( $key, 0, 8 ) === $needle ){				
				$trimedArray[trim($key,$needle)] = $hay;
			}			
		}
		
		//Checks if array is empty
		if(count(array_unique($trimedArray)) == 1){
			$trimedArray = null;
		}
		
		
		return $trimedArray;
		
	}
	
	
	public static function getChildrenCategories($idList, $counter = 0, $additionalWhere = '', $removeGivenIdListFromResult = FALSE) {
		/** @var \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface $cache */
		$cache = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager')->getCache('cache_news_category');
		$cacheIdentifier = sha1('children' . $idList);
	
		$entry = $cache->get($cacheIdentifier);
		if (!$entry) {
			$entry = self::getChildrenCategoriesRecursive($idList, $counter, $additionalWhere);
			$cache->set($cacheIdentifier, $entry);
		}
	
		if ($removeGivenIdListFromResult) {
			$entry = self::removeValuesFromString($entry, $idList);
		}
	
		return $entry;
	}
						
	
}
