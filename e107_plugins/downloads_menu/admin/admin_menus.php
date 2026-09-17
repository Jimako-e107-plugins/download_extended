<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - menu display preferences.
 */

if (!defined('e107_INIT'))
{
	require_once('../../../class2.php');
}

require_once(__DIR__ . '/admin_menu.php');

class downloads_menu_menus_ui extends e_admin_ui
{
	protected $pluginTitle = LAN_DLMENU_ADMIN_MENUS;
	protected $pluginName  = 'downloads_menu';

	protected $fields    = null;
	protected $fieldpref = array();

	protected $preftabs = array(LAN_DLMENU_TAB_LATEST, LAN_DLMENU_TAB_TOP);

	protected $prefs = array(

		// --- Latest downloads menu ---

		'latest_amount' => array(
			'title' => LAN_DLMENU_PREF_AMOUNT, 'tab' => 0, 'type' => 'number', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_AMOUNT_HELP, 'writeParms' => array('size' => 'small', 'min' => 1, 'max' => 50),
		),
		'latest_category' => array(
			'title' => LAN_DLMENU_PREF_CATEGORY, 'tab' => 0, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_CATEGORY_HELP,
		),
		'latest_author' => array(
			'title' => LAN_DLMENU_PREF_AUTHOR, 'tab' => 0, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_AUTHOR_HELP,
		),
		'latest_size' => array(
			'title' => LAN_DLMENU_PREF_SIZE, 'tab' => 0, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_SIZE_HELP,
		),
		'latest_datestamp' => array(
			'title' => LAN_DLMENU_PREF_DATESTAMP, 'tab' => 0, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_DATESTAMP_HELP,
		),
		'latest_requested' => array(
			'title' => LAN_DLMENU_PREF_REQUESTED, 'tab' => 0, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_REQUESTED_HELP,
		),
		'latest_description' => array(
			'title' => LAN_DLMENU_PREF_DESCRIPTION, 'tab' => 0, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_DESCRIPTION_HELP,
		),
		'latest_maxchars' => array(
			'title' => LAN_DLMENU_PREF_MAXCHARS, 'tab' => 0, 'type' => 'number', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_MAXCHARS_HELP, 'writeParms' => array('size' => 'small'),
		),
		'latest_adminlink' => array(
			'title' => LAN_DLMENU_PREF_ADMINLINK, 'tab' => 0, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_ADMINLINK_HELP,
		),

		// --- Top downloads menu ---

		'top_amount' => array(
			'title' => LAN_DLMENU_PREF_AMOUNT, 'tab' => 1, 'type' => 'number', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_AMOUNT_HELP, 'writeParms' => array('size' => 'small', 'min' => 1, 'max' => 50),
		),
		'top_category' => array(
			'title' => LAN_DLMENU_PREF_CATEGORY, 'tab' => 1, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_CATEGORY_HELP,
		),
		'top_author' => array(
			'title' => LAN_DLMENU_PREF_AUTHOR, 'tab' => 1, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_AUTHOR_HELP,
		),
		'top_size' => array(
			'title' => LAN_DLMENU_PREF_SIZE, 'tab' => 1, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_SIZE_HELP,
		),
		'top_datestamp' => array(
			'title' => LAN_DLMENU_PREF_DATESTAMP, 'tab' => 1, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_DATESTAMP_HELP,
		),
		'top_requested' => array(
			'title' => LAN_DLMENU_PREF_REQUESTED, 'tab' => 1, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_REQUESTED_HELP,
		),
		'top_description' => array(
			'title' => LAN_DLMENU_PREF_DESCRIPTION, 'tab' => 1, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_DESCRIPTION_HELP,
		),
		'top_maxchars' => array(
			'title' => LAN_DLMENU_PREF_MAXCHARS, 'tab' => 1, 'type' => 'number', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_MAXCHARS_HELP, 'writeParms' => array('size' => 'small'),
		),
		'top_adminlink' => array(
			'title' => LAN_DLMENU_PREF_ADMINLINK, 'tab' => 1, 'type' => 'boolean', 'data' => 'int',
			'help' => LAN_DLMENU_PREF_ADMINLINK_HELP,
		),
	);

	public function renderHelp()
	{
		return array(
			'caption' => LAN_HELP,
			'text'    => LAN_DLMENU_ADMIN_MENUS_HELP,
		);
	}
}

class downloads_menu_menus_form_ui extends e_admin_form_ui
{
}

/**
 * Makes this file's own URL work without a query string: the dispatcher would
 * otherwise fall back to the first entry of $adminMenu.
 */
class downloads_menu_menus_area extends downloads_menu_adminArea
{
	protected $defaultMode   = 'menus';
	protected $defaultAction = 'prefs';
}

if (e_PAGE === 'admin_menus.php')
{
	new downloads_menu_menus_area();

	require_once(e_ADMIN . 'auth.php');

	e107::getAdminUI()->runPage();

	require_once(e_ADMIN . 'footer.php');

	exit;
}
