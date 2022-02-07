<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
 */

if (!defined('e107_INIT')) { exit; }

$LATEST_MENU_WRAPPER['item']['JMDOWNLOAD_CATEGORY'] 		= LAN_JMD_DOWNLOADS_IN_CATEGORY."<span>{---}</span><br />";
$LATEST_MENU_WRAPPER['item']['JMDOWNLOAD_SIZE'] 			= LAN_JMD_DOWNLOADS_FILESIZE."<span>{---}</span><br />";
$LATEST_MENU_WRAPPER['item']['JMDOWNLOAD_AUTHOR'] 			= LAN_JMD_DOWNLOADS_AUTHOR."<span>{---}</span><br />";

$LATEST_MENU_TEMPLATE['caption'] = '{MENU_CAPTION}';
$LATEST_MENU_TEMPLATE['start'] = '<div class="row">';
 
 
$LATEST_MENU_TEMPLATE['item']['item'] = '
<div class="col-24">
    <div id="top-download-{DOWNLOAD_POSITION}">
			<a href="{DOWNLOAD_VIEW_LINK}"><h5 class="contenttitle">{DOWNLOAD_LIST_NAME}</h5></a> 
			{DOWNLOAD_CATEGORY} 
			{DOWNLOAD_LIST_FILESIZE}
            {JMDOWNLOAD_META_DESCRIPTION}
            {DOWNLOAD_LIST_AUTHOR}
            {DOWNLOAD_ADMIN_EDIT}
            {DOWNLOAD_VIEW_DATE_SHORT}
    </div>
 </div> 
 ';
$LATEST_MENU_TEMPLATE['item']['separator'] = '';
$LATEST_MENU_TEMPLATE['end'] = '</div> ';  