<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - latest downloads menu.
 */

if (!defined('e107_INIT'))
{
	exit;
}

if (!e107::isInstalled('download'))
{
	return;
}

e107::plugLan('downloads_menu', 'front', true);
e107::plugLan('download', 'front', true);

$sql = e107::getDb();
$tp  = e107::getParser();

$template = e107::getTemplate('downloads_menu', 'latest_menu');

if (empty($template['item']))
{
	return;
}

// --- menu parameters ---------------------------------------------------

if (is_string($parm))
{
	parse_str($parm, $parms);
}
else
{
	$parms = $parm;
}

if (isset($parms['caption'][e_LANGUAGE]))
{
	$parms['caption'] = $parms['caption'][e_LANGUAGE];
}

$pref = e107::getPlugPref('downloads_menu');

$caption = !empty($parms['caption']) ? $tp->toHTML($parms['caption'], false, 'defs') : LAN_DLMENU_LATEST;
$cat     = (int) varset($parms['category'], 0);

// the preference sets the count; a menu parameter overrides it for this placement
$limit = (int) varset($pref['latest_amount'], 5);

if (!empty($parms['limit']))
{
	$limit = (int) $parms['limit'];
}

if ($limit < 1 || $limit > 50)
{
	$limit = 5;
}

// tablerender() needs a style id; never let it arrive empty
$style = !empty($parms['tablestyle']) ? preg_replace('/[^\w-]/', '', $parms['tablestyle']) : 'downloads_latest';

// --- data --------------------------------------------------------------

$where = ($cat > 0) ? ' AND d.download_category = ' . $cat : '';

$qry = "SELECT d.download_id, d.download_name, d.download_sef, d.download_url,
		d.download_author, d.download_datestamp, d.download_filesize, d.download_description,
		d.download_requested, d.download_mirror_type, d.download_category,
		dc.download_category_id, dc.download_category_name, dc.download_category_sef
	FROM #download AS d
	LEFT JOIN #download_category AS dc ON d.download_category = dc.download_category_id
	WHERE d.download_active > 0
		AND d.download_visible REGEXP '" . e_CLASS_REGEXP . "'
		AND d.download_class REGEXP '" . e_CLASS_REGEXP . "'
		AND dc.download_category_class REGEXP '" . e_CLASS_REGEXP . "'
		" . $where . "
	ORDER BY d.download_datestamp DESC
	LIMIT 0, " . $limit;

if (!$sql->gen($qry))
{
	return;
}

// drained first: some download shortcodes run their own queries
$rows = array();

while ($row = $sql->fetch())
{
	$rows[] = $row;
}

// --- render ------------------------------------------------------------

$sc = e107::getScBatch('download', true);

// makes $..._WRAPPER['item'] from the template file apply
$sc->wrapper('latest_menu/item');

$text = $tp->parseTemplate(varset($template['start'], ''), true, $sc);

foreach ($rows as $row)
{
	$sc->setVars($row);
	$text .= $tp->parseTemplate($template['item'], true, $sc);
}

$text .= $tp->parseTemplate(varset($template['end'], ''), true, $sc);

e107::getRender()->tablerender($caption, $text, $style);
