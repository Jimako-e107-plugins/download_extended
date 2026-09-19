<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - latest_menu template.
 *
 * Bootstrap 5 list-group markup. e_render_class::tablestyle() flags any text
 * starting with <ul as a list, so the bootstrap5 theme drops the <ul> straight
 * into <div class="card"> with no card-body; list-group-flush supplies the
 * padding and separators.
 *
 * Every placeholder comes from the core download shortcode batch
 * (e107_plugins/download/download_shortcodes.php).
 *
 * The preferences set in Admin -> Downloads Menus decide which fields end up in
 * the item markup: a field that is switched off is simply not written into the
 * template below. A theme that overrides this file owns that decision instead
 * and can ignore the preferences entirely.
 */

if (!defined('e107_INIT'))
{
	exit;
}

$dlmPref = e107::getPlugPref('downloads_menu');

// Wrappers are dropped whole when the shortcode returns nothing, so a file with
// no author recorded shows no empty markup. Put labels and separators here.
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_CATEGORY']         = '<span class="downloads-menu-meta downloads-menu-category">{---}</span>';
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_LIST_AUTHOR']      = '<span class="downloads-menu-meta downloads-menu-author">{---}</span>';
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_LIST_FILESIZE']    = '<span class="downloads-menu-meta downloads-menu-size">{---}</span>';
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_LIST_DATESTAMP']   = '<span class="downloads-menu-meta downloads-menu-date">{---}</span>';
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_LIST_REQUESTED']   = '<span class="downloads-menu-meta downloads-menu-requested">{---}</span>';
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_VIEW_DESCRIPTION'] = '<div class="downloads-menu-description">{---}</div>';

// --- fields, switched by the preferences --------------------------------

$dlmCategory  = varset($dlmPref['latest_category'], 1)  ? '{DOWNLOAD_CATEGORY}' : '';
$dlmAuthor    = varset($dlmPref['latest_author'], 0)    ? '{DOWNLOAD_LIST_AUTHOR}' : '';
$dlmSize      = varset($dlmPref['latest_size'], 1)      ? '{DOWNLOAD_LIST_FILESIZE}' : '';
$dlmDate      = varset($dlmPref['latest_datestamp'], 1) ? '{DOWNLOAD_LIST_DATESTAMP}' : '';
$dlmRequested = varset($dlmPref['latest_requested'], 0) ? '{DOWNLOAD_LIST_REQUESTED}' : '';
$dlmAdmin     = varset($dlmPref['latest_adminlink'], 0) ? '{DOWNLOAD_ADMIN_EDIT}' : '';

$dlmDescription = '';

if (varset($dlmPref['latest_description'], 0))
{
	// {DOWNLOAD_VIEW_DESCRIPTION=120} - the core shortcode takes the length as
	// its parameter; 0 means no limit.
	$dlmChars = (int) varset($dlmPref['latest_maxchars'], 0);

	$dlmDescription = ($dlmChars > 0) ? '{DOWNLOAD_VIEW_DESCRIPTION=' . $dlmChars . '}' : '{DOWNLOAD_VIEW_DESCRIPTION}';
}

// --- template -----------------------------------------------------------

$LATEST_MENU_TEMPLATE['start'] = '<ul class="list-group list-group-flush downloads-latest-menu">';

$LATEST_MENU_TEMPLATE['item'] = '<li class="list-group-item">
		{DOWNLOAD_LIST_NEWICON}{DOWNLOAD_LIST_NAME}' . $dlmAdmin . '
		<small class="d-block text-muted">' . $dlmCategory . $dlmAuthor . $dlmSize . $dlmDate . $dlmRequested . '</small>
		' . $dlmDescription . '
	</li>';

$LATEST_MENU_TEMPLATE['end'] = '</ul>';
