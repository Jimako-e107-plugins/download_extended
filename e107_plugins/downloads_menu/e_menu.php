<?php
/*
 * e107 website system
 *
 * Copyright (C) e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * downloads_menu plugin - Menu Manager parameter forms.
 */

if (!defined('e107_INIT'))
{
	exit;
}

e107::plugLan('downloads_menu', 'admin', true);

class downloads_menu_menu
{
	/**
	 * Menu Manager parameter form.
	 *
	 * @param string $menu Menu file name without the trailing "_menu" - e107 passes
	 *                     "downloads_latest" for downloads_latest_menu.php and
	 *                     "downloads_top" for downloads_top_menu.php.
	 * @return array e_admin_form_ui field definitions, keyed by parameter name.
	 *               The keys become the $parm keys inside the menu file.
	 */
	public function config($menu = '')
	{
		$fields = array();

		$common = array(

			'caption' => array(
				'title'      => LAN_DLMENU_PARM_CAPTION,
				'type'       => 'text',
				'multilan'   => true,
				'writeParms' => array('size' => 'xxlarge'),
			),

			'limit' => array(
				'title'      => LAN_DLMENU_PARM_LIMIT,
				'type'       => 'number',
				'writeParms' => array('size' => 'small', 'min' => 1, 'max' => 50),
			),

			'category' => array(
				'title'      => LAN_DLMENU_PARM_CATEGORY,
				'type'       => 'dropdown',
				'writeParms' => array('optArray' => $this->getCategories()),
			),

			// tablerender() style id. Each menu supplies its own default via
			// styleField(); the value is never allowed to reach tablerender() empty.
			'tablestyle' => array(
				'title'      => LAN_DLMENU_PARM_TABLESTYLE,
				'type'       => 'text',
				'writeParms' => array('size' => 'large'),
			),
		);

		switch ($menu)
		{
			case 'downloads_latest':
				$fields = array(
					'caption'    => $common['caption'],
					'limit'      => $common['limit'],
					'category'   => $common['category'],
					'tablestyle' => $this->styleField($common['tablestyle'], 'downloads_latest'),
				);
				break;

			case 'downloads_top':
				$fields = array(
					'caption'  => $common['caption'],
					'limit'    => $common['limit'],
					'category' => $common['category'],

					'period' => array(
						'title'      => LAN_DLMENU_PARM_PERIOD,
						'type'       => 'dropdown',
						'writeParms' => array('optArray' => $this->getPeriods()),
					),

					'tablestyle' => $this->styleField($common['tablestyle'], 'downloads_top'),
				);
				break;
		}

		return $fields;
	}

	/**
	 * @param array  $field   The shared tablestyle field definition.
	 * @param string $default Style id pre-filled in the form.
	 * @return array
	 */
	private function styleField($field, $default)
	{
		$field['writeParms']['default'] = $default;

		return $field;
	}

	/**
	 * @return array download_category_id => name, with 0 for "all categories".
	 */
	private function getCategories()
	{
		$list = array(0 => LAN_DLMENU_ALL_CATEGORIES);

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

	/**
	 * @return array number of days => label, with 0 for "all time".
	 */
	private function getPeriods()
	{
		return array(
			0   => LAN_DLMENU_PERIOD_ALL,
			7   => LAN_DLMENU_PERIOD_WEEK,
			30  => LAN_DLMENU_PERIOD_MONTH,
			365 => LAN_DLMENU_PERIOD_YEAR,
		);
	}
}
