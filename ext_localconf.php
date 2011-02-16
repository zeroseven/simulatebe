<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

	// Add Plugin to Static Template #43
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_simulatebe_pi1.php', '_pi1', '', 0);

?>