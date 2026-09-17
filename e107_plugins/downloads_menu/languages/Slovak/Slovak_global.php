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

	'LAN_DLMENU_PLUGIN_NAME'       => "Menu pre súbory na stiahnutie",
	'LAN_DLMENU_PLUGIN_SUMMARY'    => "Menu a štatistiky pre jadrový plugin Downloads",
	'LAN_DLMENU_PLUGIN_DIZ'        => "Pridáva menu s najnovšími súbormi, menu s najsťahovanejšími súbormi a administračný prehľad záznamov o stiahnutiach. Vyžaduje jadrový plugin Downloads.",

);
