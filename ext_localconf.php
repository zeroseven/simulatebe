<?php
+defined('TYPO3_MODE') or die();

// Add Plugin to Static Template #43
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43(
	$_EXTKEY,
	'pi1/class.tx_simulatebe_pi1.php',
	'_pi1',
	'',
	0
);

if (TYPO3_MODE == 'FE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_userauth.php']['logoff_post_processing'][]
		= 'tx_simulatebe_pi1->logout';
}

if(!function_exists('user_belogged_in')) {
	function user_belogged_in() {
		if(isset($GLOBALS['BE_USER'])) {
			return !empty($GLOBALS['BE_USER']->user['uid']);
		};
		return false;
	}
}
