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
 *   52: class tx_contentcoverflow_contentflow
 *
 *              SECTION: There havn't been written templates to adjust output
 *   71:     function getHTML_coverFlowListElement($imageSrc,$imagealttext,$link)
 *   91:     function getHTML_coverFlow($HTML_coverFlowList)
 *  120:     function getHTML_additionalHeaderData()
 *
 * TOTAL FUNCTIONS: 3
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

/**
 * class.tx_contentcoverflow_contentflow.php
 *
 * Coverflow inclusion for the 'contentcoverflow' extension.
 *
 * @author  Joerg Kummer <typo3 et enobe dot de>
 * @package  TYPO3
 * @subpackage tx_contentcoverflow
 * @based on MooFlow (c) 2006 - 2010 Tobias Wetzel, http://outcut.de/MooFlow
 */
class tx_contentcoverflow_contentflow {

	var $appConf;


	/***************************************************************
	 * There havn't been written templates to adjust output
	 * You'll find all hardcoded HTML-snippets here
	 ***************************************************************/

	/**
	 * Get HTML of cover flow list element
	 *
	 * @param	string		$imageSrc
	 * @param	string		$imagealttext: ...
	 * @param	string		$link: ...
	 * @return	string		HTML of coverFlowList
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getHTML_coverFlowListElement($imageSrc,$imagealttext,$link) {
			// get HTML of image flow list element
		$coverFlowListElement = '
			<div class="item" href="' . $link . '" target="_self" >
				<img class="content" src="' . $imageSrc . '" title="' . $title . '" alt="' . $imagealttext . '" />
				<div class="caption">' . $title . '</div>
			</div>
		';
			// output
		return $coverFlowListElement;
	}


	/**
	 * Get HTML of cover flow
	 *
	 * @param	string		HTML of coverFlow
	 * @return	string		HTML of coverFlow
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getHTML_coverFlow($HTML_coverFlowList) {
			// get HTML of image flow
		$HTML_coverFlow = '
			<div class="ContentFlow" id="cf">
				<div class="loadIndicator"><div class="indicator"></div></div>
				<div class="flow">
					'.$HTML_coverFlowList.'
				</div>
				<div class="globalCaption"></div>
				<div class="scrollbar">
					<div class="preButton"></div>
					<div class="nextButton"></div>
					<div class="slider">
						<!-- <div class="position"></div> -->
					</div>
				</div>
			</div>
		';
			// output
		return $HTML_coverFlow;
	}


	/**
	 * Get additional headers as css & js
	 *
	 * @return	void
	 * @author	Joerg Kummer <typo3 et enobe dot de>
	 */
	function getHTML_additionalHeaderData() {
			// chek addons and get its values
		if (is_array($this->appConf['addons.'])) {
			foreach ($this->appConf['addons.'] as $key => $addon) {
					// ATTENTION, it takes only one/last element. its not checked, if more than one addon is working korrectly
				$addon_loader = 'load="' . $addon['name'] . '"';
				$addon_stylesheet = '<link rel="stylesheet" href="' . $addon['css.']['file'] . '" type="text/css" />';
			}
		}
			// additional headers as css & js, including addons
		$GLOBALS['TSFE']->additionalHeaderData['contentcoverflow'] .= '
			<!-- This includes the coverFlow CSS and JavaScript -->
			<link rel="stylesheet" href="' . $this->appConf['css.']['file'] . '" type="text/css" />
			' . $addon_stylesheet . '
			<script type="text/javascript" src="' . $this->appConf['js.']['file'] . '" ' . $addon_loader . ' ></script>
		';
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/pi1/tx_contentcoverflow_contentflow.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/pi1/tx_contentcoverflow_contentflow.php']);
}

?>
