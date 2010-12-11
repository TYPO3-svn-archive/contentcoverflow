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
?>