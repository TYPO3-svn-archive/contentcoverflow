<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';

	// Adds the plugins to the TCA
t3lib_extMgm::addPlugin(array('LLL:EXT:contentcoverflow/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:contentcoverflow/flexform_ds_pi1.xml');

	// Static TS
t3lib_extMgm::addStaticFile($_EXTKEY,"static/","Content CoverFlow");

	// TCA
t3lib_extMgm::allowTableOnStandardPages('tx_contentcoverflow_content');
t3lib_extMgm::addToInsertRecords('tx_contentcoverflow_content');

$TCA["tx_contentcoverflow_content"] = array (
	"ctrl" => array (
		'title' => 'LLL:EXT:contentcoverflow/locallang_db.xml:tx_contentcoverflow_content',		
		'label' => 'title',	
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE, 
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',	
		'transOrigPointerField' => 'l18n_parent',	
		'transOrigDiffSourceField' => 'l18n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',	
			'starttime' => 'starttime',	
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_contentcoverflow_content.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, starttime, endtime, title, flexform",
	),
);
?>