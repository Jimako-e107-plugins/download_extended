<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - global language file.
 *
 * e107 loads every installed plugin's *_global.php on every request, front and
 * admin (class2.php -> GlobalLanguageList::loadAll()). The plugin identity
 * constants belong here because they are needed in both: plugin.xml resolves
 * lan="..." through them, and the admin pages use them for the menu title.
 */

return array(

	'LAN_DLMENU_PLUGIN_NAME'       => "Menu pro soubory ke stažení",
	'LAN_DLMENU_PLUGIN_SUMMARY'    => "Menu a statistiky pro jádrový plugin Downloads",
	'LAN_DLMENU_PLUGIN_DIZ'        => "Přidává menu s nejnovějšími soubory, menu s nejstahovanějšími soubory a administrační přehled záznamů o stažení. Vyžaduje jádrový plugin Downloads.",

);
