<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT')) {
    exit;
}

class latest_downloads_list
{
    protected $plugPrefs = array();
    protected $amount;

    public function __construct()
    {
        $this->plugPrefs = e107::getPlugPref('download_extended');
    }


    public function getListData($limit = 5)
    {
       
		$limit = ($limit == 0) ? $this->plugPrefs['menu_latest_amount']  : $limit;
        $qry = " AND find_in_set(download_visible,'" . USERCLASS_LIST . "')  ";

        $qry = "SELECT d.*,
            dc.download_category_name, dc.download_category_id, dc.download_category_sef 
			FROM #download AS d
			LEFT JOIN #download_category AS dc ON d.download_category=dc.download_category_id
			WHERE 
			d.download_active > '0' ".$qry."
			ORDER BY download_datestamp DESC LIMIT 0,".intval($limit)." ";
                                                                   
        $downloads = e107::getDB()->retrieve($qry, true);

        return $downloads;
    }

	public function setWhatIsDisplayed($template = '') {
        if(!$this->plugPrefs['menu_latest_category'])  $search[] = '{DOWNLOAD_CATEGORY}';
		if(!$this->plugPrefs['menu_latest_date'])  $search[] = '{DOWNLOAD_VIEW_DATE_SHORT}';
		if(!$this->plugPrefs['menu_latest_author'])  $search[] = '{DOWNLOAD_LIST_AUTHOR}';
		if(!$this->plugPrefs['menu_latest_adminlink'])  $search[] = '{DOWNLOAD_ADMIN_EDIT}';
		if(!$this->plugPrefs['menu_latest_description'])  $search[] = '{DOWNLOAD_VIEW_DESCRIPTION}';
		if(!$this->plugPrefs['menu_latest_description'])  $search[] = '{JMDOWNLOAD_META_DESCRIPTION}';
		if(!$this->plugPrefs['menu_latest_size'])  $search[] = '{DOWNLOAD_LIST_FILESIZE}';
 
		$replace = '';
		$template = str_replace($search, $replace, $template);
 
		return $template;

	}
}
