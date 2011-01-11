<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/*
	// get extension confArr
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['contentcoverflow']);
	// l10n_mode for the image field
$l10n_mode_image = ($confArr['l10n_mode_imageExclude']?'exclude':'mergeIfNotBlank');
	// hide new localizations
$hideNewLocalizations = ($confArr['hideNewLocalizations']?'mergeIfNotBlank':'');
*/

require_once(t3lib_extMgm::extPath('contentcoverflow').'res/class.tx_contentcoverflow_customtca.php');

$TCA['tx_contentcoverflow_content'] = array (
	'ctrl' => $TCA['tx_contentcoverflow_content']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l18n_parent,l18n_diffsource,hidden,starttime,endtime,title,flexform'
	),
	'feInterface' => $TCA['tx_contentcoverflow_content']['feInterface'],
	'columns' => array (
		't3ver_label' => array (		
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'max' => '30',
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table' => 'tx_contentcoverflow_content',
				'foreign_table_where' => 'AND tx_contentcoverflow_content.pid=###CURRENT_PID### AND tx_contentcoverflow_content.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'l10n_mode' => $hideNewLocalizations,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'starttime' => array (		
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array (
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (		
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array (
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'checkbox' => '0',
				'default' => '0',
				'range' => array (
					'upper' => mktime(0,0,0,12,31,2020),
					'lower' => mktime(0,0,0,date('m')-1,date('d'),date('Y'))
				)
			)
		),
		'title' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:contentcoverflow/locallang_db.xml:tx_contentcoverflow_content.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'flexform' => array(
			'l10n_display' => 'hideDiff',
			'label' => 'LLL:EXT:contentcoverflow/locallang_db.xml:tx_contentcoverflow_content.flexform',
			'config' => Array (
				'type' => 'flex',
				#'ds_pointerField' => 'list_type,CType',
				'ds' => array(
					'default' => file_get_contents(t3lib_extMgm::extPath('contentcoverflow') . 'flexform_select.xml'),
				)
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, hidden;;1, title;;;;2-2-2, flexform')
	),
	'palettes' => array (
		'1' => array('showitem' => 'starttime, endtime')
	)
);

?>