<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * jm_download menu file.
 *
 */


if (!defined('e107_INIT')) { exit; }

$text = "";
e107::lan("download_extended");

$template = e107::getTemplate('download_extended', 'latest_menu'); 

require_once(e_PLUGIN."/download_extended/classes/latest_downloads_class.php");
$latest_downloads = new latest_downloads_list(); 


/* CAPTION FROM MENU SETTINGS */
$menu_caption = '';

if(isset($parm['menuCaption'][e_LANGUAGE]))
{
	$menu_caption = $parm['menuCaption'][e_LANGUAGE];
}
else $menu_caption = $parm['menuCaption']; 

$vars = array('{MENU_CAPTION}' => $menu_caption);

$caption  = str_replace(array_keys($vars), $vars, $template['caption']);    
 
/* ITEM LIMIT FROM MENU SETTINGS */
$menu_limit = 5;
if(isset($parm['menuLimit']))
{
	$menu_limit = $parm['menuLimit'];
}
else $menu_limit = $parm['menuLimit']; 


/* TABLERENDER FROM MENU SETTINGS */
$menu_tablestyle = 0;
if(isset($parm['menuTableStyle']))
{
	$menu_tablestyle = $parm['menuTableStyle'];
}
else $menu_tablestyle = $parm['menuTableStyle']; 
 


 
$listArray = $latest_downloads->getListData($menu_limit);
 
$start    =  $tp->parseTemplate($template[$sectiontemplate]['start'] );

//$sc = e107::getScBatch('download_extended', 'download_extended');

$sc2 = e107::getScBatch('download_extended', true);
//$sc->wrapper('download/view');

/*	 * Example e107::getScBatch('contact')->wrapper('contact/form');
	 * which results in using the $CONTACT_WRAPPER['form'] wrapper in the parsing phase   */
	 
$sc2->wrapper('latest_menu/item');
 
$start    =  $tp->parseTemplate($template['start'], true, $sc2);
$end      =  $tp->parseTemplate($template['end'], true, $sc2);

 
$items ='';
 
$item_template = $latest_downloads->setWhatIsDisplayed($template['item']['item']);

foreach ($listArray as  $v)
{			
	$sc2->setVars($v);   
    $items    .=  $tp->parseTemplate($item_template, true, $sc2);       
}

e107::getRender()->tablerender($caption, $start.$items.$end, $menu_tablestyle);

 