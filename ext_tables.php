<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");
$tempColumns = Array (
	"tx_simulatebe_beuser" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:simulatebe/locallang_db.xml:fe_users.tx_simulatebe_beuser",		
		"config" => Array (
			"type" => "select",	
			"items" => Array (
				Array("",0),
			),
			"foreign_table" => "be_users",	
			"foreign_table_where" => "ORDER BY be_users.username",	
			"size" => 1,	
			"minitems" => 0,
			"maxitems" => 1,
		)
	),
);


t3lib_div::loadTCA("fe_users");
t3lib_extMgm::addTCAcolumns("fe_users",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("fe_users","--div--;LLL:EXT:simulatebe/locallang_db.xml:fe_users.tx_simulatebe,tx_simulatebe_beuser;;;;1-1-1");

$tempColumns = Array (
	"tx_simulatebe_feuserusername" => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:simulatebe/locallang_db.xml:be_users.tx_simulatebe_feuserusername",
		"config" => Array (
			"type" => "input",
			"size" => 30,
		)
	),
);


t3lib_div::loadTCA("be_users");
t3lib_extMgm::addTCAcolumns("be_users",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("be_users","--div--;LLL:EXT:simulatebe/locallang_db.xml:be_users.tx_simulatebe,tx_simulatebe_feuserusername;;;;1-1-1");

?>