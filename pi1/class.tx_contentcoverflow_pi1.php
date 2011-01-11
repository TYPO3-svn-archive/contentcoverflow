<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Joerg Kummer <typo3 et enobe dot de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   60: class tx_contentcoverflow_pi1 extends tslib_pibase
 *   83:     function main($content, $conf)
 *  113:     function init()
 *  152:     function getcoverFlow()
 *  179:     function getContentsArray()
 *  226:     function getElements_contentTable($selectArray,$vDef='vDEF')
 *  273:     function getElementsArray($res, $table)
 *  330:     function getElementsArraySorted($unsortedArray, $key='date')
 *  356:     function getTopicElement($itemsArraySorted, $itemKey='date')
 *  413:     function getcoverFlowList($itemsArray)
 *  447:     function checkImageSrc($imageName,$imageUploadDir)
 *  468:     function getImageSrc($imageFile, $imageConfig = '')
 *
 * TOTAL FUNCTIONS: 11
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(PATH_tslib.'class.tslib_pibase.php');

/**
 * class.tx_contentcoverflow_pi1.php
 *
 * Plugin 'contentcoverflow' for the 'contentcoverflow' extension.
 * Coverflow/slideshow for images from tt_news and others
 *
 * @author  Joerg Kummer <typo3 et enobe dot de>
 * @package  TYPO3
 * @subpackage tx_contentcoverflow
 */
class tx_contentcoverflow_pi1 extends tslib_pibase {

	var $cObj; 	// The backReference to the mother cObj object set at call time
	var $prefixId = 'tx_contentcoverflow_pi1';
		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_contentcoverflow_pi1.php'; 	// Path to this script relative to the extension dir.
	var $extKey = 'contentcoverflow'; 	// The extension key.
	var $pi_checkCHash = true;
		// Upload directory for content (contentcoverflow,tt_news,tt_content...)
	var $uploadDir_ttnews;

	var $HTML;	// instance for HTML output
	var $errorMsg;	// error messages


	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	string		$output: The content that is displayed on the website
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function main($content, $conf) {
			// set config
		$this->conf = $conf;
			// Loading TypoScript array into object variable:
		$this->pi_setPiVarDefaults(); 	// Set default piVars from TS
			// Loading language-labels
		#$this->pi_loadLL();
			// Init FlexForm configuration for plugin:
		$this->pi_initPIflexForm();
			// Initialize new cObj object
		$this->local_cObj = t3lib_div::makeInstance('tslib_cObj'); 	// Local cObj.
			// further initalises (..prozess TS-configs)
		$this->init();
			// get content
		if (is_object($this->HTML)) {
			$output = $this->getcoverFlow();
				// output
			return $this->pi_wrapInBaseClass($output);
		} else {
			return $this->errorMsg;
		}
	}


	/**
	 * Initialize configs by TS-configs (stdWrap)
	 *
	 * @return	void
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function init() {
			// upload dir
		$this->uploadDir_ttnews = ($this->conf['tt_news.']['uploadDir']) ? $this->conf['tt_news.']['uploadDir'] : 'uploads/pics/';
			// cover flow app
		if ($this->conf['coverFlowApp']) {
			switch(trim($this->conf['coverFlowApp'])) {
				default:
				case 'imageflow':
					require_once(t3lib_extMgm::extPath('contentcoverflow').'pi1/class.tx_contentcoverflow_imageflow.php');
					$this->HTML = t3lib_div::makeInstance('tx_contentcoverflow_imageflow');
					$this->HTML->appConf = $this->conf['coverFlowSetup.']['imageflow.'];
					break;
				case 'mooflow':
					require_once(t3lib_extMgm::extPath('contentcoverflow').'pi1/class.tx_contentcoverflow_mooflow.php');
					$this->HTML = t3lib_div::makeInstance('tx_contentcoverflow_mooflow');
					$this->HTML->appConf = $this->conf['coverFlowSetup.']['mooflow.'];
					break;
				case 'contentflow':
					require_once(t3lib_extMgm::extPath('contentcoverflow').'pi1/class.tx_contentcoverflow_contentflow.php');
					$this->HTML = t3lib_div::makeInstance('tx_contentcoverflow_contentflow');
					$this->HTML->appConf = $this->conf['coverFlowSetup.']['contentflow.'];
					break;
			}
		}
			// check loaded coverflow app
		if (!is_object($this->HTML)) {
			$this->errorMsg .= '
				No CoverFlow application loaded. Please check TypoScript Setup: \'include from static\'
			';
		}
	}


	/**
	 * Get image flow
	 *
	 * @return	string		$HTML_coverFlow
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getcoverFlow() {
			// *?
		$contentsArray = $this->getContentsArray();
			// get others
		#$othersArray = array();
			// merge news and others
		$itemsArray = $contentsArray[0]; # array_merge($contentTableArray, $othersArray);
			// sort news and others
		$itemsArraySorted = $this->getElementsArraySorted($itemsArray,'date');
			// get topical element
		$topicId = $this->getTopicElement($itemsArraySorted,'date');
			// get HTML of image list
		$HTML_coverFlowList = $this->getcoverFlowList($itemsArraySorted);
			// get HTML of all ContentFlow items
		$HTML_coverFlow = $this->HTML->getHTML_coverFlow($HTML_coverFlowList);
			// get HTML of additional headers (js,css)
		$this->HTML->getHTML_additionalHeaderData();
			// output
		return $HTML_coverFlow;
	}

	/**
	 * Get contents
	 *
	 * @return	?
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getContentsArray() {
		$contentIdList = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'contentcoverflow_content', 'sDEF');
		if (isset($contentIdList)) {
			$contentIdArray = explode(',',$contentIdList);
			if (is_array($contentIdArray)) {
				foreach ($contentIdArray as $key => $contentId) {
					$contentRows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('flexform',' tx_contentcoverflow_content','uid IN(' . $contentId . ')',$groupBy,$orderBy,$limit);
					if (is_array($contentRows)) {
						foreach ($contentRows as $contentRow) {

							if (isset($contentRow['flexform'])) {
									// xml2array
								$flexformArray = t3lib_div::xml2array($contentRow['flexform']);
								if (is_array($flexformArray['data']['sDEF']['lDEF'])) {
									$selectArray_sDEF = $flexformArray['data']['sDEF']['lDEF'];
								}
								if (is_array($flexformArray['data']['sEXT']['lDEF'])) {
									$selectArray_sEXT = $flexformArray['data']['sEXT']['lDEF'];
								}
								$selectArray = array_merge($selectArray_sDEF,$selectArray_sEXT);
								/*
									// define sheet and language
								$sDef = 'sDEF';
								$langId = $GLOBALS['TSFE']->config['config']['sys_language_uid'];
								$lDef = ($langId != 0) ? 'l' . strtoupper($this->LLkey) : 'lDEF';
								#$vDef;
								*/
							}
							$vDef = 'vDEF';
							$contentsArray[] = $this->getElements_contentTable($selectArray,$vDef);
						}
					}
				}
			}
		}
		return $contentsArray;
	}


	/**
	 * Get content elements from selected table
	 *
	 * @param	[type]		$selectArray: ...
	 * @param	[type]		$vDef: ...
	 * @return	array		$contentArray
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getElements_contentTable($selectArray,$vDef='vDEF') {
			// where
		$where = '1=1';
			// where lang
		#$where .= ' AND (' . $selectArray['table'][$vDef] . '.sys_language_uid IN (0,-1) OR (' . $selectArray['table'][$vDef] . '.sys_language_uid=0 AND NOT ' . $selectArray['table'][$vDef] . '.l18n_parent))';
			// where userdefined
		if ($selectArray['where'][$vDef]) {
			$where .= ' AND ' . $selectArray['where'][$vDef];
		}
			// where image
		$where .= ' AND ' . $selectArray['table'][$vDef] . '.' . $selectArray['field_image'][$vDef] . ' NOT LIKE \'\'';
			// where enable fields
		if (is_array($GLOBALS['TCA'][$selectArray['table'][$vDef]]['ctrl']['enablecolumns'])) {
			$where .= $this->cObj->enableFields($selectArray['table'][$vDef]);	// . $this->cObj->enableFields('tt_news_cat');
		}
			// query
		$queryParts = array(
			'SELECT' => $selectArray['table'][$vDef] . '.uid as uid,
			' . $selectArray['table'][$vDef] . '.' . $selectArray['field_title'][$vDef] . ' as title,
			' . $selectArray['table'][$vDef] . '.' . $selectArray['field_image'][$vDef] . ' as image,
			' . $selectArray['table'][$vDef] . '.' . $selectArray['field_imagecaption'][$vDef] . ' as imagealttext,
			' . $selectArray['table'][$vDef] . '.' . $selectArray['field_date'][$vDef] . ' as date',
			'FROM' => ($selectArray['from'][$vDef])? $selectArray['from'][$vDef] : $selectArray['table'][$vDef],
			'WHERE' => $where,
			'GROUPBY' => $selectArray['table'][$vDef] . '.uid',
			'ORDERBY' => $selectArray['table'][$vDef] . '.' . $selectArray['field_date'][$vDef] . ' DESC',
			'LIMIT' => $selectArray['limit'][$vDef],
		);
		/* use of '$GLOBALS['TYPO3_DB']->exec_SELECT_mm_query()' fails */
		$res = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray($queryParts);
			// array of elements
		$contentArray = $this->getElementsArray($res, $selectArray['table'][$vDef]);
			// free res
		$GLOBALS['TYPO3_DB']->sql_free_result($res);
			// output
		return $contentArray;
	}


	/**
	 * Get elements from a resource as array
	 *
	 * @param	object		$res
	 * @param	string		$table
	 * @return	array		$itemsArray
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getElementsArray($res, $table) {
			// item values depend on table
		switch($table) {
			case 'tt_news':
				$imageUploadDir = $this->uploadDir_ttnews;
				$linkPid = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'contentcoverflow_ttnews_page', 'sDEF');
				$urlParameterKey = 'tx_ttnews[tt_news]';
				break;
			case 'tt_content':
				$imageUploadDir = 'uploads/pics/';
				$linkPid = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'contentcoverflow_ttnews_page', 'sDEF');
				$urlParameterKey = 'tx_tt_content[tt_content]';
				break;
		}
			// items as array
		$itemsArray = array();
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				// push item to array, if image exists
			if ($image = $this->checkImageSrc($row['image'],$imageUploadDir)) {
				$itemsArray[] = array(
					'uid' => $row['uid'],
					'title' => $row['title'],
					'image' => $image,
					'imagealttext' => $row['imagealttext'],
					'linkPid' => $linkPid,
					'urlParameter' => array('key' => $urlParameterKey, 'val' => $row['uid']),
					#'target' => $row['target'],
					'date' => $row['date'],
				);
			} else {
					// fetch elements with broken images
				$itemsDisabled[] = array(
					'uid' => $row['uid'],
					'title' => $row['title'],
					'image' => $imageUploadDir . $row['image'],
					'date' => $row['date'],
				);
			}
		}
			// debug
		#if(is_array($itemsDisabled)) t3lib_div::debug($itemsDisabled,'$itemsDisabled');
			// output
		return $itemsArray;
	}


	/**
	 * Get elements array sorted
	 *
	 * When you query a DB you usually put your record set inside of a multi-dimentional array.
	 * This method will allow you to sort your record set by column after you put it in an array.
	 *
	 * @param	array		$unsortedArray
	 * @param	string		$key
	 * @return	array		$sortedArray
	 * @author	Jeremy Swinborne 20-Jul-2005 <http://de2.php.net/manual/en/function.usort.php#54957>
	 */
	function getElementsArraySorted($unsortedArray, $key='date') {
			// set sorted array
		$sortedArray = $unsortedArray;
			// run each element
		for ($i=0; $i < sizeof($sortedArray)-1; $i++) {
			for ($j=0; $j<sizeof($sortedArray)-1-$i; $j++) {
				if ($sortedArray[$j][$key] > $sortedArray[$j+1][$key]) {
					$tmp = $sortedArray[$j];
					$sortedArray[$j] = $sortedArray[$j+1];
					$sortedArray[$j+1] = $tmp;
				}
			}
		}
			// output
		return $sortedArray;
	}


	/**
	 * Get most topical element
	 *
	 * @param	array		elements sorted
	 * @param	string		$itemKey: like 'crdate' or 'datetime'
	 * @return	int		id of topic element
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getTopicElement($itemsArraySorted, $itemKey='date') {
		if ($this->conf['topicAtStart']) {
				// now
			$now = time();
				// younger or older than now? default: 'older than now'
			$timed = $this->conf['topicTimedFromNow'];
			switch($timed) {
				default:
				case 'older':
					$currentDate = 0;
						// search topical element
					if(is_array($itemsArraySorted)) {
						foreach($itemsArraySorted as $key => $val) {
							$itemDate = $val[$itemKey];
							if ($itemDate < $now) {
								if ($currentDate < $itemDate) {
									$topicId = $key;
									$currentDate = $itemDate;
								}
							}
							unset($itemDate);
						}
					}
					break;
				case 'younger':
					$currentDate = 9999999999;
						// search topical element
					if(is_array($itemsArraySorted)) {
						foreach($itemsArraySorted as $key => $val) {
							$itemDate = $val[$itemKey];
							if ($itemDate > $now) {
								if ($currentDate > $itemDate) {
									$topicId = $key;
									$currentDate = $itemDate;
								}
							}
							unset($itemDate);
						}
					}
					break;
			}
				// set coverFlow configs
			$this->HTML->appConf['topicAtStart'] = TRUE;
			$this->HTML->appConf['topicId'] = $topicId;
				// output
			return $topicId;
		}
	}


	/**
	 * Get HTML of image flow list with each item
	 *
	 * @param	array		$itemsArray
	 * @return	string		$HTML_coverFlowList
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getcoverFlowList($itemsArray) {
			// run each item and build HTML of coverFlowlist
		if (is_array($itemsArray)) {
			foreach ($itemsArray as $id => $item) {
					// image
				$imageSrc = $item['image'];
					// text
				$title = $item['title'];
				$imagealttext = $item['imagealttext'];
					// link
				$pid = $item['linkPid'];
				$urlParameters = array(
					$item['urlParameter']['key'] => $item['urlParameter']['val'],
					'no_cache' => '1',
					);
				$link = $this->pi_getPageLink($pid, $target, $urlParameters);
				$target = $item['target'];
					// flow item
				$HTML_coverFlowList .= $this->HTML->getHTML_coverFlowListElement($imageSrc, $title, $imagealttext, $link, $target);
			}
		}
			// output
		return $HTML_coverFlowList;
	}


	/**
	 * Check real existence of image
	 *
	 * @param	string		$imageName
	 * @param	string		$imageUploadDir
	 * @return	string		$imageSrc
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function checkImageSrc($imageName,$imageUploadDir) {
			// take first image, if a commaseparated list of multiple images is given
		$imageListArray = explode(',', $imageName);
		$image = $imageListArray[0];
			// check existens of given image, and push all data into coverFlowlist
		if ($imageSrc = $this->getImageSrc($imageUploadDir.$image)) {
			return $imageSrc;
		} else {
			return FALSE;
		}
	}


	/**
	 * Get image in predefined size as cObject (copy in temp/pics)
	 *
	 * @param	array		$imageFile
	 * @param	array		$imageConfig
	 * @return	string		$imageSrc
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getImageSrc($imageFile, $imageConfig = '') {

		if (!$imageConfig) {
			$imageConfig = array (
			'file' => $imageFile,
				'file.' => array (
				'maxW' => $this->conf['images.']['image_max_width'],
				'maxH' => $this->conf['images.']['image_max_height'],
				)
			);
		} else {
			$imageConfig['file'] = $imageFile;
		}
			// build and get temporary imgage file
		$imageSrc = $this->local_cObj->IMG_RESOURCE($imageConfig);
		return $imageSrc;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/pi1/class.tx_contentcoverflow_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/pi1/class.tx_contentcoverflow_pi1.php']);
}

?>
