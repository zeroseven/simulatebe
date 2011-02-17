<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2000-2004 Mads Brunn (brunn@mail.dk)
*  (c) 2010-2011 Sonja Scholz (ss@cabag.ch)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Plugin 'Simulate BE-session' for the extension 'simulatebe'.
 *
 * @author	Mads Brunn <brunn@mail.dk>
 * @author	Sonja Scholz <ss@cabag.ch>
 * @author	Jonas Dübi <jd@cabag.ch>
 */
require_once(PATH_t3lib . 'class.t3lib_userauth.php');
require_once(PATH_t3lib . 'class.t3lib_userauthgroup.php');
require_once(PATH_t3lib . 'class.t3lib_beuserauth.php');
require_once(PATH_tslib . 'class.tslib_feuserauth.php');
require_once(PATH_tslib . 'class.tslib_pibase.php');

class tx_simulatebe_pi1 extends t3lib_userAuth {
	/**
	 * Main function of the plugin.
	 *
	 * @param $content
	 * @param $conf array Configuration of the Plugin
	 * @return void
	 */
	public function main($content, $conf) {
			// Check if be user is logged in
			// $GLOBALS['TSFE']->beUserLogin is 0, if the user has no access to the current page,
			// but is logged in to the BE, this leads to an endless loop.
		$BE_USER = '';
			// If the backend cookie is set, we proceed and check if a backend user is logged in.
		if ($_COOKIE['be_typo_user']) {
				// New backend user object
			$BE_USER = t3lib_div::makeInstance('t3lib_tsfeBeUserAuth');
			$BE_USER->OS = TYPO3_OS;
			$BE_USER->lockIP = $GLOBALS['TYPO3_CONF_VARS']['BE']['lockIP'];
				// Object is initialized
			$BE_USER->start();
			$BE_USER->unpack_uc('');
			if ($BE_USER->user['uid']) {
				$backendUserLoggedIn = 1;
			}
		}

			// CAB
			// Original code:
			// if ((!isset($_COOKIE['simulatebe'])) && $conf['allow'] && $GLOBALS['TSFE']->loginUser
			// && intval($GLOBALS['TSFE']->fe_user->user['tx_simulatebe_beuser']) && (t3lib_div::_GP('logintype')=='login')) {
		if (!$backendUserLoggedIn && $conf['allow'] && $GLOBALS['TSFE']->loginUser) {
            $be_user_obj = t3lib_div::makeInstance('t3lib_beUserAuth');

				// CAB - SS: 28.04.10 - also look for a be_user where the feusername field contains the current username
			if (intval($GLOBALS['TSFE']->fe_user->user['tx_simulatebe_beuser'])) {
					// Let's get the record for the backend user we want to simulate in the frontend.
				$dbres = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
							'*',
							$be_user_obj->user_table,
							($be_user_obj->checkPid ?
								'pid IN (' . $GLOBALS['TYPO3_DB']->cleanIntList($be_user_obj->checkPid_value) . ') AND ' :
								''
							) . ' uid=' . $GLOBALS['TSFE']->fe_user->user['tx_simulatebe_beuser'] . ' ' .
							$be_user_obj->user_where_clause()
						);
			} else {
					// Let's get the record for the backend user we want to simulate in the frontend.
				$dbres = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
							'*',
							$be_user_obj->user_table,
							($be_user_obj->checkPid ?
								'pid IN (' . $GLOBALS['TYPO3_DB']->cleanIntList($be_user_obj->checkPid_value) . ') AND ' :
								''
							) . ' tx_simulatebe_feuserusername=\'' . $GLOBALS['TSFE']->fe_user->user['username'] . '\' ' .
							$be_user_obj->user_where_clause()
						);
			}

				// If no be_user is found, return.
			if ($tempuser = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbres)) {
				$this->beuser = $tempuser;
			} else {
				return;
			}

				// Faking a be-session for our frontend user.
				// The be-session gets the same id and hashlock as the current fe-session. Don't know if this is usefull but..
			$insertFields = array(
					'ses_id' => $GLOBALS['TSFE']->fe_user->user['ses_id'],
					'ses_name' => $be_user_obj->name,
					'ses_iplock' => $this->beuser['disableIPlock'] ?
						'[DISABLED]' : $be_user_obj->ipLockClause_remoteIPNumber($be_user_obj->lockIP),
					'ses_hashlock' => $GLOBALS['TSFE']->fe_user->user['ses_hashlock'],
					'ses_userid' => $this->beuser[$be_user_obj->userid_column],
					'ses_tstamp' => $GLOBALS['EXEC_TIME']
			);
				// CAB - check if there already is an entry first
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'ses_id',
					$be_user_obj->session_table,
					"ses_id = '" . $GLOBALS['TSFE']->fe_user->user['ses_id'] . "' "
			);
			if (($sessionRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) == FALSE) {
				$GLOBALS['TYPO3_DB']->exec_INSERTquery($be_user_obj->session_table, $insertFields);
			}

				// Setting the cookies
				// Also check if the session array isset
			if (intval($GLOBALS['TYPO3_DB']->sql_affected_rows()) || is_array($sessionRow)) {
				setcookie($be_user_obj->name, $GLOBALS['TSFE']->fe_user->user['ses_id'], 0, '/');
				setcookie('simulatebe', $GLOBALS['TSFE']->fe_user->user['ses_id'], 0, '/');

					// Reload
				header('Location: ' . t3lib_div::getIndpEnv('TYPO3_REQUEST_URL'));
			}
		}

			// Logout
			// CAB: use $_COOKIE[be_typo_user] instead of $_COOKIE[simulatebe]
		if ((isset($_COOKIE['be_typo_user']) && ($_COOKIE['simulatebe']==$_COOKIE['be_typo_user']))
			&& $conf['allow']
			&& (!$GLOBALS['TSFE']->loginUser)
			&& (t3lib_div::_GP('logintype')=='logout')) {

            $be_user_obj = t3lib_div::makeInstance('t3lib_beUserAuth');

			$GLOBALS['TYPO3_DB']->exec_DELETEquery(
					$be_user_obj->session_table,
					'ses_id = "' . $GLOBALS['TYPO3_DB']->quoteStr($_COOKIE['be_typo_user'], $be_user_obj->session_table) . '"
						AND ses_name = "' . $GLOBALS['TYPO3_DB']->quoteStr($be_user_obj->name, $be_user_obj->session_table) . '"'
					);

			setcookie($be_user_obj->name, '', 0, '/');
			setcookie('simulatebe', '', 0, '/');
			header('Location: ' . t3lib_div::getIndpEnv('TYPO3_REQUEST_URL'));
		}
	}
}


if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/simulatebe/pi1/class.tx_simulatebe_pi1.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/simulatebe/pi1/class.tx_simulatebe_pi1.php']);
}

?>