<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - top_menu template.
 *
 * Same Bootstrap 5 list-group markup and the same preference handling as
 * latest_menu_template.php - see the header there.
 *
 * {PERIOD_COUNT} and {PERIOD_DAYS} are plain string tokens replaced by
 * downloads_top_menu.php before parsing, not shortcodes.
 */

if (!defined('e107_INIT'))
{
	exit;
}

$dlmPref = e107::getPlugPref('downloads_menu');

$TOP_MENU_WRAPPER['item']['DOWNLOAD_CATEGORY']         = '<span class="downloads-menu-meta downloads-menu-category">{---}</span>';
$TOP_MENU_WRAPPER['item']['DOWNLOAD_LIST_AUTHOR']      = '<span class="downloads-menu-meta downloads-menu-author">{---}</span>';
$TOP_MENU_WRAPPER['item']['DOWNLOAD_LIST_FILESIZE']    = '<span class="downloads-menu-meta downloads-menu-size">{---}</span>';
$TOP_MENU_WRAPPER['item']['DOWNLOAD_LIST_DATESTAMP']   = '<span class="downloads-menu-meta downloads-menu-date">{---}</span>';
$TOP_MENU_WRAPPER['item']['DOWNLOAD_LIST_REQUESTED']   = '<span class="downloads-menu-meta downloads-menu-requested">{---}</span>';
$TOP_MENU_WRAPPER['item']['DOWNLOAD_VIEW_DESCRIPTION'] = '<div class="downloads-menu-description">{---}</div>';

// --- fields, switched by the preferences --------------------------------

$dlmCategory  = varset($dlmPref['top_category'], 1)  ? '{DOWNLOAD_CATEGORY}' : '';
$dlmAuthor    = varset($dlmPref['top_author'], 0)    ? '{DOWNLOAD_LIST_AUTHOR}' : '';
$dlmSize      = varset($dlmPref['top_size'], 1)      ? '{DOWNLOAD_LIST_FILESIZE}' : '';
$dlmDate      = varset($dlmPref['top_datestamp'], 1) ? '{DOWNLOAD_LIST_DATESTAMP}' : '';
$dlmRequested = varset($dlmPref['top_requested'], 0) ? '{DOWNLOAD_LIST_REQUESTED}' : '';
$dlmAdmin     = varset($dlmPref['top_adminlink'], 0) ? '{DOWNLOAD_ADMIN_EDIT}' : '';

$dlmDescription = '';

if (varset($dlmPref['top_description'], 0))
{
	$dlmChars = (int) varset($dlmPref['top_maxchars'], 0);

	$dlmDescription = ($dlmChars > 0) ? '{DOWNLOAD_VIEW_DESCRIPTION=' . $dlmChars . '}' : '{DOWNLOAD_VIEW_DESCRIPTION}';
}

// --- template -----------------------------------------------------------

$TOP_MENU_TEMPLATE['start'] = '<ul class="list-group list-group-flush downloads-top-menu">';

$TOP_MENU_TEMPLATE['item'] = '<li class="list-group-item d-flex justify-content-between align-items-start">
		<span class="me-2">
			{DOWNLOAD_LIST_NAME}' . $dlmAdmin . '
			<small class="d-block text-muted">' . $dlmCategory . $dlmAuthor . $dlmSize . $dlmDate . $dlmRequested . '</small>
			' . $dlmDescription . '
		</span>
		<span class="badge bg-primary rounded-pill">{PERIOD_COUNT}</span>
	</li>';

$TOP_MENU_TEMPLATE['end'] = '</ul>';
