<?php

########################################################################
# Extension Manager/Repository config file for ext "contentcoverflow".
#
# Auto generated 11-01-2011 23:42
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Content CoverFlow',
	'description' => 'Coverflow/slideshow for images from tt_news based on MooFlow, ImageFlow or ContentFlow',
	'category' => 'plugin',
	'author' => 'Joerg Kummer',
	'author_email' => 'typo3 et enobe dot de',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:96:{s:9:"ChangeLog";s:4:"bc67";s:10:"README.txt";s:4:"0887";s:21:"ext_conf_template.txt";s:4:"71a5";s:12:"ext_icon.gif";s:4:"b857";s:17:"ext_localconf.php";s:4:"77f3";s:15:"ext_php_api.dat";s:4:"698e";s:14:"ext_tables.php";s:4:"1ef9";s:14:"ext_tables.sql";s:4:"87bd";s:28:"ext_typoscript_editorcfg.txt";s:4:"60c3";s:19:"flexform_ds_pi1.xml";s:4:"11e6";s:19:"flexform_select.xml";s:4:"4f33";s:36:"icon_tx_contentcoverflow_content.gif";s:4:"b857";s:26:"locallang_csh_flexform.xml";s:4:"f7e4";s:16:"locallang_db.xml";s:4:"b688";s:7:"tca.php";s:4:"3cfe";s:45:"pi1/class.tx_contentcoverflow_contentflow.php";s:4:"1004";s:43:"pi1/class.tx_contentcoverflow_imageflow.php";s:4:"5ee5";s:41:"pi1/class.tx_contentcoverflow_mooflow.php";s:4:"baf6";s:37:"pi1/class.tx_contentcoverflow_pi1.php";s:4:"f333";s:17:"pi1/locallang.xml";s:4:"c872";s:43:"res/class.tx_contentcoverflow_customtca.php";s:4:"9982";s:25:"res/imageflow_modified.js";s:4:"84e6";s:25:"res/ContentFlow/CHANGELOG";s:4:"3ec9";s:44:"res/ContentFlow/ContentFlowAddOn_DEFAULT.css";s:4:"5380";s:43:"res/ContentFlow/ContentFlowAddOn_DEFAULT.js";s:4:"ba84";s:42:"res/ContentFlow/ContentFlowAddOn_white.css";s:4:"3b10";s:41:"res/ContentFlow/ContentFlowAddOn_white.js";s:4:"6cc8";s:23:"res/ContentFlow/LICENSE";s:4:"6d3b";s:30:"res/ContentFlow/changelog.html";s:4:"c0de";s:31:"res/ContentFlow/contentflow.css";s:4:"e00b";s:30:"res/ContentFlow/contentflow.js";s:4:"7019";s:35:"res/ContentFlow/contentflow_src.css";s:4:"b669";s:34:"res/ContentFlow/contentflow_src.js";s:4:"dd7f";s:25:"res/ContentFlow/docu.html";s:4:"038b";s:26:"res/ContentFlow/index.html";s:4:"21af";s:28:"res/ContentFlow/license.html";s:4:"d886";s:41:"res/ContentFlow/mycontentflow.css.example";s:4:"f948";s:26:"res/ContentFlow/styles.css";s:4:"81f3";s:25:"res/ContentFlow/title.png";s:4:"4698";s:37:"res/ContentFlow/img/1x1_0.5_black.png";s:4:"29ea";s:37:"res/ContentFlow/img/1x1_0.5_white.png";s:4:"d632";s:29:"res/ContentFlow/img/blank.gif";s:4:"6d22";s:30:"res/ContentFlow/img/loader.gif";s:4:"8eca";s:36:"res/ContentFlow/img/loader_white.gif";s:4:"ae06";s:39:"res/ContentFlow/img/scrollbar_black.png";s:4:"5b67";s:39:"res/ContentFlow/img/scrollbar_white.png";s:4:"76ff";s:36:"res/ContentFlow/img/slider_black.png";s:4:"6ef5";s:36:"res/ContentFlow/img/slider_white.png";s:4:"cf46";s:29:"res/ContentFlow/pics/pic0.png";s:4:"5f52";s:29:"res/ContentFlow/pics/pic1.png";s:4:"30c6";s:29:"res/ContentFlow/pics/pic2.png";s:4:"04ad";s:29:"res/ImageFlow/button_left.png";s:4:"bda1";s:30:"res/ImageFlow/button_pause.png";s:4:"32a3";s:29:"res/ImageFlow/button_play.png";s:4:"4410";s:30:"res/ImageFlow/button_right.png";s:4:"4410";s:25:"res/ImageFlow/favicon.ico";s:4:"fc59";s:27:"res/ImageFlow/imageflow.css";s:4:"5a4b";s:26:"res/ImageFlow/imageflow.js";s:4:"b9e0";s:34:"res/ImageFlow/imageflow.packed.css";s:4:"6788";s:33:"res/ImageFlow/imageflow.packed.js";s:4:"1d0a";s:24:"res/ImageFlow/index.html";s:4:"3394";s:26:"res/ImageFlow/reflect2.php";s:4:"f2f7";s:26:"res/ImageFlow/reflect3.php";s:4:"a5b7";s:24:"res/ImageFlow/slider.png";s:4:"b48a";s:29:"res/ImageFlow/slider_dark.png";s:4:"7b5d";s:23:"res/ImageFlow/style.css";s:4:"addf";s:26:"res/ImageFlow/img/img1.png";s:4:"029b";s:26:"res/ImageFlow/img/img2.png";s:4:"1e1b";s:26:"res/ImageFlow/img/img3.png";s:4:"b191";s:26:"res/ImageFlow/img/img4.png";s:4:"b8de";s:26:"res/MooFlow/MooFlow.Mod.js";s:4:"a03b";s:23:"res/MooFlow/MooFlow.css";s:4:"81d3";s:22:"res/MooFlow/MooFlow.js";s:4:"119f";s:26:"res/MooFlow/MooFlow.pre.js";s:4:"6e7c";s:22:"res/MooFlow/README.txt";s:4:"d5a0";s:24:"res/MooFlow/example.html";s:4:"a497";s:32:"res/MooFlow/mootools-1.2-core.js";s:4:"c492";s:32:"res/MooFlow/mootools-1.2-more.js";s:4:"6775";s:34:"res/MooFlow/mootools-1.2.3-core.js";s:4:"2107";s:36:"res/MooFlow/mootools-1.2.3.1-more.js";s:4:"2760";s:29:"res/MooFlow/img/at_symbol.jpg";s:4:"78fd";s:28:"res/MooFlow/img/farbraum.jpg";s:4:"f905";s:35:"res/MooFlow/img/stimme_von_oben.jpg";s:4:"ca34";s:27:"res/MooFlow/img/tropfen.jpg";s:4:"6f32";s:32:"res/MooFlow/skin/ajax_loader.gif";s:4:"fc44";s:38:"res/MooFlow/skin/ajax_loader_white.gif";s:4:"be1c";s:32:"res/MooFlow/skin/left-slider.gif";s:4:"31b7";s:25:"res/MooFlow/skin/left.gif";s:4:"28c9";s:34:"res/MooFlow/skin/middle-slider.gif";s:4:"0aa9";s:27:"res/MooFlow/skin/middle.gif";s:4:"bed2";s:37:"res/MooFlow/skin/mootools-1.2-core.js";s:4:"c492";s:25:"res/MooFlow/skin/play.gif";s:4:"ba4f";s:27:"res/MooFlow/skin/resize.gif";s:4:"4d4a";s:26:"res/MooFlow/skin/right.gif";s:4:"2f8a";s:25:"res/MooFlow/skin/stop.gif";s:4:"ef2c";s:16:"static/setup.txt";s:4:"7de8";}',
	'suggests' => array(
	),
);

?>