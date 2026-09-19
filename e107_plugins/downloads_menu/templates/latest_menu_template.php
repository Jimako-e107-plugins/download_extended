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
 * The markup follows the Bootstrap 5 list-group pattern used by the core
 * news menu. e_render_class::tablestyle() flags any text starting with <ul
 * as a list, which makes the bootstrap5 theme render it with the
 * 'listgroup' style: the <ul> is placed directly inside <div class="card">,
 * with no card-body around it. list-group-flush supplies the padding and
 * separators instead.
 *
 * Placeholders come from the core download shortcode batch
 * (e107_plugins/download/download_shortcodes.php):
 *   {DOWNLOAD_LIST_NAME}         linked file name
 *   {DOWNLOAD_LIST_NAME=nolink}  plain file name
 *   {DOWNLOAD_LIST_NEWICON}      "new" icon, empty when not recent
 *   {DOWNLOAD_CATEGORY}          category name
 *   {DOWNLOAD_LIST_FILESIZE}     human readable size
 *   {DOWNLOAD_LIST_DATESTAMP}    short date
 *   {DOWNLOAD_LIST_AUTHOR}       author
 *   {DOWNLOAD_LIST_REQUESTED}    download count
 *   {DOWNLOAD_LIST_LINK}         direct download link
 *   {DOWNLOAD_ADMIN_EDIT}        edit button, admins only
 */

if (!defined('e107_INIT'))
{
	exit;
}

$LATEST_MENU_TEMPLATE['start'] = '<ul class="list-group list-group-flush downloads-latest-menu">';

$LATEST_MENU_TEMPLATE['item'] = '<li class="list-group-item">
		{DOWNLOAD_LIST_NEWICON}{DOWNLOAD_LIST_NAME}
		<small class="d-block text-muted">{DOWNLOAD_CATEGORY} &middot; {DOWNLOAD_LIST_FILESIZE} &middot; {DOWNLOAD_LIST_DATESTAMP}</small>
	</li>';

$LATEST_MENU_TEMPLATE['end'] = '</ul>';
