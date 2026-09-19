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
 * Same Bootstrap 5 list-group pattern as latest_menu_template.php - see the
 * header there for why the <ul> has to carry the list-group classes itself.
 *
 * {DOWNLOAD_*} placeholders come from the core download shortcode batch.
 *
 * Two extra placeholders are plain string tokens, replaced by top_menu.php
 * before the shortcode parser runs:
 *   {PERIOD_COUNT}  number of recorded requests inside the selected period
 *   {PERIOD_DAYS}   length of that period in days, 0 when "all time"
 */

if (!defined('e107_INIT'))
{
	exit;
}

$TOP_MENU_TEMPLATE['start'] = '<ul class="list-group list-group-flush downloads-top-menu">';

$TOP_MENU_TEMPLATE['item'] = '<li class="list-group-item d-flex justify-content-between align-items-start">
		<span class="me-2">
			{DOWNLOAD_LIST_NAME}
			<small class="d-block text-muted">{DOWNLOAD_CATEGORY} &middot; {DOWNLOAD_LIST_FILESIZE}</small>
		</span>
		<span class="badge bg-primary rounded-pill">{PERIOD_COUNT}</span>
	</li>';

$TOP_MENU_TEMPLATE['end'] = '</ul>';
