<?php

// Generated e107 Plugin Admin Area 

require_once('../../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}
 

require_once("admin_leftmenu.php");
 
class download_ui extends e_admin_ui
{			
		protected $pluginTitle		= LAN_JMD_LATEST_DOWNLOADS_03;
		protected $pluginName		= 'download_extended';
 
		protected $fields 		= NULL;		
		
		protected $fieldpref = array();
		

		protected $preftabs        = array('Latest Menu', 'Top menu' );

		protected $prefs = array(
			'menu_latest_amount'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_22, 
							'tab'=>0, 
							'type'=>'number', 
							'data' => 'int', 
							'help'=>LAN_JMD_HELP_LAN_02,
							'writeParms' => array('default'=>5)
			),
			'menu_latest_author'		=> 	 array('title'=>LAN_JMD_LATEST_DOWNLOADS_27,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_06,		
			), 
			'menu_latest_category'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_47,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>'If set ON,  download category will be displayed in Latest menu'
			),

			'menu_latest_size'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_26,
			  				'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_12
			),
			'menu_latest_count'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_28,
			  				'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_14
			),
			'menu_latest_description'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_18,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_08
			  ),
			'menu_latest_usepagebreak'		=> array('title'=> 'Use pagebreak', 
							'tab'=>0, 
							'type'=>'boolean', 
							'data' => 'int', 
							'help'=>'Use pagebreak to separate summary',
							'writeParms' => array('default'=>1)
			),
			'menu_latest_maxchars'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_21, 
							'tab'=>0, 
							'type'=>'number', 
							'data' => 'int', 
							'help'=>LAN_JMD_HELP_LAN_04,
							'writeParms' => array('default'=>0)
			),
			'menu_latest_readmore'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_06, 
							'tab'=>0, 
							'type'=>'boolean', 
							'data' => 'int', 
							'help'=>LAN_JMD_LATEST_DOWNLOADS_07,
							'writeParms' => array('default'=>1)
			),
			'menu_latest_adminlink'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_04,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'int',
							'help'=>LAN_JMD_LATEST_DOWNLOADS_05
			),
			'menu_top_amount'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_22, 
							'tab'=>1, 
							'type'=>'number', 
							'data' => 'int', 
							'help'=>LAN_JMD_HELP_LAN_02,
							'writeParms' => array('default'=>5)
			),
			'menu_top_author'		=> 	 array('title'=>LAN_JMD_LATEST_DOWNLOADS_27,
							'tab'=>1,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_06,		
			), 
			'menu_top_category'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_47,
							'tab'=>1,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>'If set ON,  download category will be displayed in Latest menu'
			),

			'menu_top_size'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_26,
			  				'tab'=>1,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_12
			),
			'menu_top_count'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_28,
			  				'tab'=>1,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_14
			),
			'menu_top_description'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_18,
							'tab'=>1,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_08
			  ),
			'menu_top_usepagebreak'		=> array('title'=> 'Use pagebreak', 
							'tab'=>1, 
							'type'=>'boolean', 
							'data' => 'int', 
							'help'=>'Use pagebreak to separate summary',
							'writeParms' => array('default'=>1)
			),
			'menu_top_maxchars'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_21, 
							'tab'=>1, 
							'type'=>'number', 
							'data' => 'int', 
							'help'=>LAN_JMD_HELP_LAN_04,
							'writeParms' => array('default'=>0)
			),
			'menu_top_readmore'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_06, 
							'tab'=>1, 
							'type'=>'boolean', 
							'data' => 'int', 
							'help'=>LAN_JMD_LATEST_DOWNLOADS_07,
							'writeParms' => array('default'=>1)
			),
			'menu_top_adminlink'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_04,
							'tab'=>1,
							'type'=>'boolean',
							'data' => 'int',
							'help'=>LAN_JMD_LATEST_DOWNLOADS_05
			) 
		); 
	
	 
		// left-panel help menu area. 
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Settings that can be changed in Menu Manager: '."<br>";
			$text .= LAN_JMD_HELP_LAN_01."<br>";
			$text .= LAN_JMD_HELP_LAN_23."<br>";
			$text .= LAN_JMD_HELP_LAN_24."<br>";
			$text .= "<hr>";
			$text .= "Available menus: <br>";
			$text .= "Latest Downloads Menu <br>";
			$text .= "Top Downloads Menu <br>";
			$text .= "<hr>";
			$text .= "All settings could be replaced by used template <br>";

			return array('caption'=>$caption,'text'=> $text);

		}	
}		

class download_form_ui extends e_admin_form_ui
{

}		
			
new leftmenu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>