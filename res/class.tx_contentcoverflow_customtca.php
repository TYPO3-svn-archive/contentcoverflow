<?php
#declare(ENCODING = 'utf-8');
#namespace TYPO3\contentcoverflow;

/*                                                                        *
 * This script belongs to the TYPO3 package "contentcoverflow".           *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        *
 * You should have received a copy of the GNU General Public License      *
 * along with the script.                                                 *
 * If not, see http://www.gnu.org/licenses/gpl.html                       *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Customised user functions for TCA
 *
 * @package TYPO3
 * @subpackage contentcoverflow
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   47: class tx_contentcoverflow_customtca
 *   56:     function selectItemsTCA_tables(&$params)
 *   76:     function selectItemsTCA_tableFields(&$params)
 *
 * TOTAL FUNCTIONS: 2
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
class tx_contentcoverflow_customtca {

	/**
	 * Get array of existing Tables
	 * used as selectbox in TCA
	 *
	 * @param	array		$params
	 * @return	void
	 */
	function selectItemsTCA_tables(&$params) {
		global $TCA, $BE_USER, $LANG;

		foreach ($TCA as $tN => $value) {
			if ($BE_USER->check('tables_select',$tN)
				&& ( t3lib_div::isFirstPartOfStr($tN, 'tx_')
				|| t3lib_div::isFirstPartOfStr($tN, 'tt_'))) {
					$tL = rtrim($LANG->sl($TCA[$tN]['ctrl']['title']));	// Table label
					$params['items'][] = array(htmlspecialchars($tL . ' (' . $tN . ')'), $tN, '');
			}
		}
	}

	/**
	 * Get array of fields from a predefined table
	 * used as selectbox in TCA
	 *
	 * @param	array		$params
	 * @return	void
	 */
	function selectItemsTCA_tableFields(&$params) {

		global $TCA, $BE_USER, $LANG;
			// get table
		if ($params['row']['flexform']) {
				// xml2array
			$flexformArray = t3lib_div::xml2array($params['row']['flexform']);
			if (is_array($flexformArray['data']['sDEF']['lDEF'])) {
				$table = $flexformArray['data']['sDEF']['lDEF']['table']['vDEF'];
			}
		}
			// set params from fields
		if (is_array($TCA[$table]['columns'])) {
			$fields = array_keys($TCA[$table]['columns']);
			if (is_array($fields)) {
				foreach($fields as $fN)	{
					$fL = is_array($TCA[$table]['columns'][$fN]) ? rtrim($LANG->sL($TCA[$table]['columns'][$fN]['label']),':') : '['.$fN.']';	// Field label
					$params['items'][] = array(htmlspecialchars($fL . ' (' . $fN . ')'),$fN,'');
				}
			}
		}
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/res/class.tx_contentcoverflow_customtca.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contentcoverflow/res/class.tx_contentcoverflow_customtca.php']);
}

?>
