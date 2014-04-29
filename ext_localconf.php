<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

	// Add Plugin to Static Template #43
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_simulatebe_pi1.php', '_pi1', '', 0);

if(!function_exists('user_belogged_in')) {
	function user_belogged_in() {
		if(isset($GLOBALS['BE_USER'])) {
			return !empty($GLOBALS['BE_USER']->user['uid']);
		};
		return false;
	}
}
?>