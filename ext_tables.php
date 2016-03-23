<?php
defined('TYPO3_MODE') or die();

if (version_compare(TYPO3_branch, '6.1', '<')) {
	t3lib_div::loadTCA('fe_users');
}

// Add static template
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'static/', 'BE Login Simulation for FE Users');
