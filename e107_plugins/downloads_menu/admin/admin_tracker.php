<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - download request log.
 */

if (!defined('e107_INIT'))
{
	require_once('../../../class2.php');
}

require_once(__DIR__ . '/admin_menu.php');

class downloads_menu_tracker_ui extends e_admin_ui
{
	protected $pluginTitle = LAN_DLMENU_ADMIN_TRACKER;
	protected $pluginName  = 'downloads_menu';

	protected $table = 'dr.download_requests';
	protected $pid   = 'download_request_id';

	protected $perPage   = 40;
	protected $listOrder = 'dr.download_request_datestamp DESC';

	protected $listQry = "SELECT dr.*, d.download_name
		FROM #download_requests AS dr
		LEFT JOIN #download AS d ON d.download_id = dr.download_request_download_id";

	protected $disallow = array('create', 'edit');

	protected $batchDelete = true;
	protected $batchExport = true;
	protected $batchCopy   = false;

	protected $fields = array(

		'checkboxes' => array(
			'title'   => '',
			'type'    => null,
			'data'    => null,
			'width'   => '5%',
			'thclass' => 'center',
			'class'   => 'center',
			'forced'  => true,
			'toggle'  => 'e-multiselect',
		),

		'download_request_id' => array(
			'title' => LAN_ID,
			'data'  => 'int',
			'width' => '5%',
		),

		'download_name' => array(
			'title'   => LAN_TITLE,
			'type'    => 'text',
			'data'    => false,
			'nosort'  => true,
			'width'   => 'auto',
			'class'   => 'left',
			'thclass' => 'left',
		),

		'download_request_download_id' => array(
			'title'  => LAN_DOWNLOAD,
			'type'   => 'dropdown',
			'data'   => 'int',
			'width'  => 'auto',
			'filter' => true,
			'batch'  => false,
			'nolist' => true,
		),

		'download_request_userid' => array(
			'title'  => LAN_USER,
			'type'   => 'user',
			'data'   => 'int',
			'width'  => 'auto',
			'filter' => true,
			'class'  => 'left',
			'thclass' => 'left',
		),

		'download_request_ip' => array(
			'title' => LAN_IP,
			'type'  => 'ip',
			'data'  => 'str',
			'width' => 'auto',
			'class' => 'left',
			'thclass' => 'left',
		),

		'download_request_datestamp' => array(
			'title'  => LAN_DATESTAMP,
			'type'   => 'datestamp',
			'data'   => 'int',
			'width'  => 'auto',
			'filter' => true,
		),

		'options' => array(
			'title'   => LAN_OPTIONS,
			'type'    => null,
			'data'    => null,
			'width'   => '10%',
			'thclass' => 'center last',
			'class'   => 'center last',
			'forced'  => true,
		),
	);

	protected $fieldpref = array(
		'download_request_id',
		'download_name',
		'download_request_userid',
		'download_request_ip',
		'download_request_datestamp',
	);

	public function init()
	{
		$this->fields['download_request_download_id']['writeParms']['optArray'] = $this->downloadList();
	}

	/**
	 * @return array download_id => download_name, for the filter drop-down.
	 */
	private function downloadList()
	{
		$list = array();

		$sql = e107::getDb();

		if (!$sql->gen("SELECT download_id, download_name FROM #download ORDER BY download_name ASC"))
		{
			return $list;
		}

		while ($row = $sql->fetch())
		{
			$list[(int) $row['download_id']] = $row['download_name'];
		}

		return $list;
	}

	public function renderHelp()
	{
		return array(
			'caption' => LAN_HELP,
			'text'    => LAN_DLMENU_ADMIN_TRACKER_HELP,
		);
	}
}

class downloads_menu_tracker_form_ui extends e_admin_form_ui
{
}

/**
 * Makes this file's own URL work without a query string: the dispatcher would
 * otherwise fall back to the first entry of $adminMenu.
 */
class downloads_menu_tracker_area extends downloads_menu_adminArea
{
	protected $defaultMode   = 'tracker';
	protected $defaultAction = 'list';
}

if (e_PAGE === 'admin_tracker.php')
{
	new downloads_menu_tracker_area();

	require_once(e_ADMIN . 'auth.php');

	e107::getAdminUI()->runPage();

	require_once(e_ADMIN . 'footer.php');

	exit;
}
