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
 *   52: class tx_contentcoverflow_imageflow
 *
 *              SECTION: There havn't been written templates to adjust output
 *   72:     function getHTML_coverFlowListElement($imageSrc, $title, $imagealttext, $link, $target = '_self')
 *   89:     function getHTML_coverFlow($HTML_coverFlowList)
 *  107:     function getHTML_additionalHeaderData()
 *
 * TOTAL FUNCTIONS: 3
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

/**
 * class.tx_contentcoverflow_imageflow.php
 *
 * Coverflow inclusion for the 'contentcoverflow' extension.
 *
 * @author  Joerg Kummer <typo3 et enobe dot de>
 * @package  TYPO3
 * @subpackage tx_contentcoverflow
 * @based on MooFlow (c) 2006 - 2010 Tobias Wetzel, http://outcut.de/MooFlow
 */
class tx_contentcoverflow_imageflow {

	var $appConf;

	/***************************************************************
	 * There havn't been written templates to adjust output
	 * You'll find all hardcoded HTML-snippets here
	 ***************************************************************/

	/**
	 * Get HTML of cover flow list element
	 *
	 * @param	string		$imageSrc
	 * @param	string		$title
	 * @param	string		$imagealttext
	 * @param	string		$link
	 * @param	string		$target
	 * @return	string		$HTML_coverFlowListElement
	 * @author Joerg Kummer <typo3 et enobe dot de>
	 */
	function getHTML_coverFlowListElement($imageSrc, $title, $imagealttext, $link, $target = '_self') {
			// get HTML of image flow list element
		$HTML_coverFlowListElement = '
			<img class="if_image" src="' . $imageSrc . '" title="' . htmlSpecialChars($title) . '" alt="' . htmlSpecialChars($imagealttext) . '" longdesc="' . $link . '" />
		';
			// output
		return $HTML_coverFlowListElement;
	}


	/**
	 * Get HTML of cover flow
	 *
	 * @param	string		$HTML_coverFlowList
	 * @return	string		$HTML_coverFlow
	 * @author Joerg Kummer <typo3 et enobe dot de>
	 */
	function getHTML_coverFlow($HTML_coverFlowList) {
			// get HTML of image flow
		$HTML_coverFlow = '
			<div id="contentcoverflowImageFlow" class="imageflow">
			'.$HTML_coverFlowList.'
			</div>
		';
			// output
		return $HTML_coverFlow;
	}


	/**
	 * Get additional headers as css & js
	 *
	 * @return	array		void
	 * @author Joerg Kummer <typo3 et enobe dot de>
	 */
	function getHTML_additionalHeaderData() {
			// get js configs
			// get topical element and overwrite startID in appConf['js.']['config.']
		if ($this->appConf['topicAtStart']) {
			$this->appConf['js.']['config.']['startID'] = $this->appConf['topicId'] +1;
		}
			// only boolean and integers allowed, strings ar not supported
		if (is_array($this->appConf['js.']['config.'])) {
			$configArray = array();
			foreach ($this->appConf['js.']['config.'] as $key => $val) {
				$configArray[] = trim($key) . ': ' . trim($val);
			}
			$config = implode(', ',$configArray);
		}
			// additional headers as css & js
		$GLOBALS['TSFE']->additionalHeaderData['contentcoverflow'] .= '
			<script language="JavaScript" type="text/javascript" src="' . $this->appConf['js.']['file'] . '"></script>
			<link rel="stylesheet" type="text/css" href="' . $this->appConf['css.']['file'] . '" />
			<script type="text/javascript">
				/* <![CDATA[ */
					domReady(function() {
						var instanceOne = new ImageFlow();
						instanceOne.init({
							ImageFlowID: \'contentcoverflowImageFlow\',
							reflectPath: \'typo3conf/ext/contentcoverflow/res/ImageFlow/\',
							' . $config . '
						});
					});
				/* ]]> */
			</script>
		';
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/pi1/tx_contentcoverflow_imageflow.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/pi1/tx_contentcoverflow_imageflow.php']);
}

?>
