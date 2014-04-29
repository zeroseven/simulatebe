#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
	tx_simulatebe_beuser int(11) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'be_users'
#
CREATE TABLE be_users (
	tx_simulatebe_feuserusername tinytext DEFAULT '' NOT NULL
);
