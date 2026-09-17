<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - shared admin dispatcher.
 */

if (!defined('e107_INIT'))
{
	require_once('../../../class2.php');
}

if (!getperms('P'))
{
	e107::redirect('admin');
	exit;
}

e107::plugLan('downloads_menu', 'global', true);
e107::plugLan('downloads_menu', 'admin', true);
e107::plugLan('download', 'front', true);

/**
 * Modes, left-hand menu and permissions shared by every page of this plugin.
 *
 * Each mode names the file its controller lives in, so the dispatcher loads
 * whatever the requested mode needs on its own - see e_admin_dispatcher::
 * _initController(). Any of the three pages can therefore serve any mode.
 *
 * Page files subclass this and set $defaultMode / $defaultAction, which is
 * what makes their URL work on its own, with no query string.
 */
class downloads_menu_adminArea extends e_admin_dispatcher
{
	protected $modes = array(

		'menus' => array(
			'controller' => 'downloads_menu_menus_ui',
			'path'       => '{e_PLUGIN}downloads_menu/admin/admin_menus.php',
			'ui'         => 'downloads_menu_menus_form_ui',
			'uipath'     => '{e_PLUGIN}downloads_menu/admin/admin_menus.php',
		),

		'tracker' => array(
			'controller' => 'downloads_menu_tracker_ui',
			'path'       => '{e_PLUGIN}downloads_menu/admin/admin_tracker.php',
			'ui'         => 'downloads_menu_tracker_form_ui',
			'uipath'     => '{e_PLUGIN}downloads_menu/admin/admin_tracker.php',
		),

		'stats' => array(
			'controller' => 'downloads_menu_stats_ui',
			'path'       => '{e_PLUGIN}downloads_menu/admin/admin_tracker_stats.php',
			'ui'         => 'downloads_menu_stats_form_ui',
			'uipath'     => '{e_PLUGIN}downloads_menu/admin/admin_tracker_stats.php',
		),
	);

	protected $adminMenu = array(

		'menus/prefs'  => array('caption' => LAN_DLMENU_ADMIN_MENUS,   'perm' => 'P', 'url' => 'admin_menus.php'),
		'stats/list'   => array('caption' => LAN_DLMENU_ADMIN_STATS,   'perm' => 'P', 'url' => 'admin_tracker_stats.php'),
		'tracker/list' => array('caption' => LAN_DLMENU_ADMIN_TRACKER, 'perm' => 'P', 'url' => 'admin_tracker.php'),
	);

	protected $menuTitle = LAN_DLMENU_PLUGIN_NAME;
}
