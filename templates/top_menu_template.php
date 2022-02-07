<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT')) { exit; }

$TOP_MENU_WRAPPER['item']['JMDOWNLOAD_CATEGORY'] 		= LAN_JMD_DOWNLOADS_IN_CATEGORY."<span>{---}</span><br />";
$TOP_MENU_WRAPPER['item']['JMDOWNLOAD_SIZE'] 			= LAN_JMD_DOWNLOADS_FILESIZE."<span>{---}</span><br />";
$TOP_MENU_WRAPPER['item']['JMDOWNLOAD_AUTHOR'] 			= LAN_JMD_DOWNLOADS_AUTHOR."<span>{---}</span><br />";

$TOP_MENU_TEMPLATE['caption'] = '{MENU_CAPTION}';

$TOP_MENU_TEMPLATE['start'] = '<div id="latest-downloads-menu"><div class="row">';
$TOP_MENU_TEMPLATE['end'] = '</div></div>  ';  
 
$TOP_MENU_TEMPLATE['item']['item'] = '
<div class="col-24">	 
		<div id="top-download-{DOWNLOAD_POSITION}">
			<h5>{DOWNLOAD_LIST_NAME}</h5> 
			{DOWNLOAD_CATEGORY}
            {DOWNLOAD_LIST_AUTHOR}           
			'.LAN_JMD_TOPDOWNLOADS_IN_PERIOD.'{JMDOWNLOAD_PERIOD}: {JMDOWNLOAD_LAST_PERIOD_COUNT} <br />
			{DOWNLOAD_SIZE}
            {JMDOWNLOAD_META_DESCRIPTION}
			{DOWNLOAD_VIEW_DATE_SHORT}{DOWNLOAD_ADMIN_EDIT}
		</div> 
  
 </div> 
 ';
$TOP_MENU_TEMPLATE['item']['separator'] = '<div class="separator"><!-- --></div>';
 