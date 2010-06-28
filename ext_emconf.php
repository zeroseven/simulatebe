<?php

########################################################################
# Extension Manager/Repository config file for ext "simulatebe".
#
# Auto generated 28-06-2010 16:14
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'BE-login simulation for fe-users',
	'description' => 'Simulates BE-login for FE-users. With this extension you can grant frontend users backend user rights. This means that if a frontend user logs into the frontend and she has the proper rights the edit icons will be displayed allowing her to edit the content.',
	'category' => 'fe',
	'shy' => 0,
	'dependencies' => 'cms',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'fe_users',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author' => 'Sonja Scholz',
	'author_email' => 'ss@cabag.ch',
	'author_company' => 'cab services ag',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '2.0.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '3.5.0-0.0.0',
			'php' => '3.0.0-0.0.0',
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:12:{s:9:"ChangeLog";s:4:"8f1a";s:12:"ext_icon.gif";s:4:"103a";s:17:"ext_localconf.php";s:4:"1ca8";s:14:"ext_tables.php";s:4:"e9e3";s:14:"ext_tables.sql";s:4:"02ac";s:28:"ext_typoscript_constants.txt";s:4:"f265";s:24:"ext_typoscript_setup.txt";s:4:"c24f";s:16:"locallang_db.php";s:4:"5946";s:14:"doc/manual.sxw";s:4:"383d";s:19:"doc/wizard_form.dat";s:4:"ebe7";s:20:"doc/wizard_form.html";s:4:"9c48";s:31:"pi1/class.tx_simulatebe_pi1.php";s:4:"33e0";}',
	'suggests' => array(
	),
);

?>