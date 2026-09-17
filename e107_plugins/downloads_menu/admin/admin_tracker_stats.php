<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - per-download request statistics.
 */

if (!defined('e107_INIT'))
{
	require_once('../../../class2.php');
}

require_once(__DIR__ . '/admin_menu.php');

class downloads_menu_stats_ui extends e_admin_ui
{
	protected $pluginTitle = LAN_DLMENU_ADMIN_STATS;
	protected $pluginName  = 'downloads_menu';

	protected $table = 'd.download';
	protected $pid   = 'download_id';

	protected $perPage   = 25;
	protected $listOrder = 'd.download_requested DESC';

	protected $disallow = array('create', 'edit', 'delete');

	protected $batchDelete = false;
	protected $batchExport = false;
	protected $batchCopy   = false;

	protected $fields = array(

		'download_id' => array(
			'title' => LAN_ID,
			'data'  => 'int',
			'width' => '5%',
		),

		'download_name' => array(
			'title'   => LAN_TITLE,
			'type'    => 'text',
			'data'    => false,
			'width'   => 'auto',
			'class'   => 'left',
			'thclass' => 'left',
		),

		'download_category' => array(
			'title'  => LAN_CATEGORY,
			'type'   => 'dropdown',
			'data'   => false,
			'width'  => 'auto',
			'filter' => true,
		),

		'download_requested' => array(
			'title' => LAN_DLMENU_STATS_COUNTER,
			'type'  => 'number',
			'data'  => 'int',
			'width' => 'auto',
			'class' => 'center',
			'thclass' => 'center',
		),

		'requests_week' => array(
			'title'   => LAN_DLMENU_STATS_WEEK,
			'type'    => 'method',
			'data'    => false,
			'nosort'  => true,
			'width'   => 'auto',
			'class'   => 'center',
			'thclass' => 'center',
		),

		'requests_month' => array(
			'title'   => LAN_DLMENU_STATS_MONTH,
			'type'    => 'method',
			'data'    => false,
			'nosort'  => true,
			'width'   => 'auto',
			'class'   => 'center',
			'thclass' => 'center',
		),

		'requests_total' => array(
			'title'   => LAN_DLMENU_STATS_TOTAL,
			'type'    => 'method',
			'data'    => false,
			'nosort'  => true,
			'width'   => 'auto',
			'class'   => 'center',
			'thclass' => 'center',
		),

		'options' => array(
			'title'   => LAN_OPTIONS,
			'type'    => 'method',
			'data'    => null,
			'width'   => '10%',
			'thclass' => 'center last',
			'class'   => 'center last',
			'forced'  => true,
		),
	);

	protected $fieldpref = array(
		'download_name',
		'download_category',
		'download_requested',
		'requests_week',
		'requests_month',
		'requests_total',
	);

	public function init()
	{
		$week  = time() - (7 * 86400);
		$month = time() - (30 * 86400);

		// One grouped pass over #download_requests, joined back to #download.
		// IFNULL keeps downloads that were never requested in the list.
		$this->listQry = "SELECT d.download_id, d.download_name, d.download_category, d.download_requested,
				IFNULL(r.requests_week, 0)  AS requests_week,
				IFNULL(r.requests_month, 0) AS requests_month,
				IFNULL(r.requests_total, 0) AS requests_total
			FROM #download AS d
			LEFT JOIN (
				SELECT download_request_download_id AS did,
					COUNT(*) AS requests_total,
					SUM(download_request_datestamp >= " . $week . ") AS requests_week,
					SUM(download_request_datestamp >= " . $month . ") AS requests_month
				FROM #download_requests
				GROUP BY download_request_download_id
			) AS r ON r.did = d.download_id";

		$this->fields['download_category']['writeParms']['optArray'] = $this->categoryList();
	}

	/**
	 * @return array download_category_id => name, for the filter drop-down.
	 */
	private function categoryList()
	{
		$list = array();

		$sql = e107::getDb();

		if (!$sql->gen("SELECT download_category_id, download_category_name FROM #download_category ORDER BY download_category_name ASC"))
		{
			return $list;
		}

		while ($row = $sql->fetch())
		{
			$list[(int) $row['download_category_id']] = $row['download_category_name'];
		}

		return $list;
	}

	public function renderHelp()
	{
		return array(
			'caption' => LAN_HELP,
			'text'    => LAN_DLMENU_ADMIN_STATS_HELP,
		);
	}
}

class downloads_menu_stats_form_ui extends e_admin_form_ui
{
	public function requests_week($curVal, $mode)
	{
		return ($mode === 'read') ? $this->counterBadge($curVal) : '';
	}

	public function requests_month($curVal, $mode)
	{
		return ($mode === 'read') ? $this->counterBadge($curVal) : '';
	}

	public function requests_total($curVal, $mode)
	{
		return ($mode === 'read') ? $this->counterBadge($curVal) : '';
	}

	/**
	 * Link to the request log, pre-filtered to this download.
	 */
	public function options($parms, $value, $id, $attributes)
	{
		if ($attributes['mode'] !== 'read')
		{
			return '';
		}

		$downloadId = (int) $this->getController()->getListModel()->get('download_id');

		if ($downloadId < 1)
		{
			return '';
		}

		$link = 'admin_tracker.php?mode=tracker&amp;action=list&amp;filter_options=download_request_download_id__' . $downloadId;

		return "<a href='" . $link . "' class='btn btn-default btn-secondary e-tip' title='" . LAN_DLMENU_STATS_DETAILS . "'>"
			. e107::getParser()->toGlyph('fa-list')
			. '</a>';
	}

	/**
	 * @param int|string $count
	 * @return string
	 */
	private function counterBadge($count)
	{
		$count = (int) $count;

		return ($count > 0) ? "<span class='badge'>" . $count . '</span>' : '0';
	}
}

/**
 * Makes this file's own URL work without a query string: the dispatcher would
 * otherwise fall back to the first entry of $adminMenu.
 */
class downloads_menu_stats_area extends downloads_menu_adminArea
{
	protected $defaultMode   = 'stats';
	protected $defaultAction = 'list';
}

if (e_PAGE === 'admin_tracker_stats.php')
{
	new downloads_menu_stats_area();

	require_once(e_ADMIN . 'auth.php');

	e107::getAdminUI()->runPage();

	require_once(e_ADMIN . 'footer.php');

	exit;
}
