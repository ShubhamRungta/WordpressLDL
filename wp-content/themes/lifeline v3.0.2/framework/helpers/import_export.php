<?php if( ! defined('ABSPATH')) exit('restricted access');
class SH_import_export
{
	private $path = '';
	
	function __construct()
	{
		$this->_webnukes = &$GLOBALS['_webnukes'];
		$this->path = get_template_directory().DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'backup';
	}
	
	function export()
	{
		$this->sidebar_export();
		$this->theme_options_export();
		if( function_exists('rev_slider_shortcode') ) $this->revslider_export();		
		if( function_exists( 'layerslider' )) $this->layerslider_export();
		if( function_exists('vc_map') ) $this->vc_template_export();
	}
	
	function import()
	{
		$this->sidebar_import();
		$this->theme_options_import();
		if( function_exists('rev_slider_shortcode') ) $this->revslider_import();
		if( function_exists( 'layerslider' )) $this->layerslider_import();
		if( function_exists('vc_map') ) $this->vc_template_import();
	}
	
	function vc_template_export( $file = '' )
	{
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		
		$data = array();
		
		$settings = get_option( 'wpb_js_templates' );
		
		$dir = $this->newdir($this->path.DIRECTORY_SEPARATOR.'vc_options');
		$fp = $this->file_open($dir.$file);
		$this->write_file($fp, $this->encrypt($settings));
		$this->file_close($fp);
	}
	
	function vc_template_import( $file = '' )
	{
		global $wpdb;
		
		$file = ($file) ? $file : 'default_settings';
		
		$settings = $this->read_file($this->newdir($this->path.DIRECTORY_SEPARATOR.'vc_options').$file);
	
		update_option( 'wpb_js_templates', $settings );
	}
	
	function revslider_export( $file = '' )
	{
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		
		$data = array();
		
		$sliders = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."revslider_sliders", ARRAY_A);
		$slides = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."revslider_slides", ARRAY_A);
		foreach( $sliders as $k=>$s )
		{
			$slider_id = sh_set( $s, 'id' );
			if( isset( $s['id'] ) ) unset( $s['id']);
			$data['slider'][$k] = $s;
			foreach( $slides as $ss )
			{
				if( isset( $ss['id'] ) ) unset( $ss['id']);
				
				if( $slider_id == sh_set( $ss, 'slider_id' ) )
				$data['slider'][$k]['slides'][] = $ss ;
			}
		}
		
		//printr($data);
		
		$dir = $this->newdir($this->path.DIRECTORY_SEPARATOR.'revslider_options');
		$fp = $this->file_open($dir.$file);
		$this->write_file($fp, $this->encrypt($data));
		$this->file_close($fp);
	}
	
	function revslider_import( $file = '' )
	{
		global $wpdb;
		
		$file = ($file) ? $file : 'default_settings';
		$settings = $this->read_file($this->newdir($this->path.DIRECTORY_SEPARATOR.'revslider_options').$file);
		foreach( (array)$settings['slider'] as $v )
		{
			$slider_id = '';
			
			$res = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."revslider_sliders` WHERE `title` LIKE '%".$v['title']."%'");
			if( $res ) continue;
			
			$slides = sh_set( $v, 'slides' );
			if( $slides ) unset( $v['slides'] );
			
			$wpdb->insert( $wpdb->prefix."revslider_sliders", $v );
			$slider_id = $wpdb->insert_id;
			
			if( $slider_id ) {
				foreach( $slides as $key => $val )
				{
					if( $val ){
						$val['slider_id'] = $slider_id;
						$wpdb->insert( $wpdb->prefix."revslider_slides", $val );
					}
				}
			}
			
		}
	}
	
	function layerslider_import( $file = '' )
	{
		global $wpdb;
		
		$file = ($file) ? $file : 'default_settings';
		$settings = $this->read_file($this->newdir($this->path.DIRECTORY_SEPARATOR.'layerslider_options').$file);
		foreach( (array)$settings['slider'] as $v )
		{			
			$res = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."layerslider` WHERE `name` LIKE '%".$v['name']."%'");
			if( $res ) continue;		
									
				$data = $v;
				$wpdb->insert( $wpdb->prefix."layerslider", array(
					'id' => $data['id'],
					'author' => $data['author'],
					'name' => $data['name'],
					'slug' => $data['slug'],
					'data' => $data['data'],
					'date_c' => $data['date_c'],
					'date_m' => $data['date_m']
				), array(
					'%d', '%d', '%s', '%s', '%s', '%d', '%d'
				));
				//$wpdb->insert_id;		
		}
	}
	
	function layerslider_export( $file = '' )
	{
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		
		$data = array();
		
		$sliders = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."layerslider", ARRAY_A);
		
		$data = array();
		$data['slider'] = $sliders;

		$dir = $this->newdir($this->path.DIRECTORY_SEPARATOR.'layerslider_options');
		$fp = $this->file_open($dir.$file);
		$this->write_file($fp, $this->encrypt($data));
		$this->file_close($fp);
	}
	
	function theme_options_import($file = '')
	{
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		
		$data = $this->read_file($this->newdir($this->path.DIRECTORY_SEPARATOR.'theme_options').$file);
		
		$v = $this->replace_pseudo($data);
		update_option(SH_NAME, $v);
		
		
		/** Update the front page */
		$front_page = get_page_by_title('Home');
		$blog_page = get_page_by_title('Blog');
		if($front_page){
			if(get_option('show_on_front') != 'page' && !get_option('page_on_front')) 
			{
				update_option('show_on_front', 'page');
				update_option('page_on_front', $front_page->ID);
				update_option('page_for_posts', $blog_page->ID);
			}
		}
		update_option('posts_per_page', 6);
		
		$res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."terms WHERE ".$wpdb->prefix."terms.slug = 'main-menu' OR ".$wpdb->prefix."terms.slug = 'footer-menu'");
		if($res){
			$nav_menu = array();
			$nav_menu['nav_menu_locations']['footer_menu'] = $res[0]->term_id;
			$nav_menu['nav_menu_locations']['main_menu'] = $res[1]->term_id;
			update_option('theme_mods_'.basename(get_template_directory()), $nav_menu);
		}
				
	}
	
	function theme_options_export($file = '')
	{
		$file = ($file) ? $file : 'default_settings';
		
		//$data = array();
		$options = get_option(SH_NAME);
		$data = $this->pseudo($options);
		
		$dir = $this->newdir($this->path.DIRECTORY_SEPARATOR.'theme_options');
		$fp = $this->file_open($dir.$file);
		$this->write_file($fp, $this->encrypt($data));
		$this->file_close($fp);
	}
	
	function sidebar_import($file = '')
	{
		$file = ($file) ? $file : 'default_settings';
		
		$data = $this->read_file($this->newdir($this->path.DIRECTORY_SEPARATOR.'widgets').$file);
		if( ! isset($data['settings']) || ! isset($data['sidebars'])) return;
		
		foreach($data['settings'] as $k=>$v)
		{
			update_option('widget_'.$k, $this->replace_pseudo($v));
		}
		
		/** Now update sidebars settings */
		update_option('sidebars_widgets', $data['sidebars']);
	}
	
	function sidebar_export($file = '')
	{
		$file = ($file) ? $file : 'default_settings';
		
		$settings = array();
		$sidebars = wp_get_sidebars_widgets();
		
		if(isset($sidebars['wp_inactive_widgets'])) unset($sidebars['wp_inactive_widgets']);
		
		foreach($sidebars as $name=>$widgets)
		{
			if( ! count($widgets) || $name == 'orphaned_widgets') continue;
			
			foreach($widgets as $widget)
			{
				if(preg_match('#(.*?)-(\d+)$#', $widget, $matches))
				{
					$type = $matches[1];
					$id = $matches[2];
					
					if($widget_settings = get_option('widget_'.$type))
					{
						$settings[$type][$id] = $this->pseudo($widget_settings[$id]);
					}
				}
			}
		}
		
		$dir = $this->newdir($this->path.DIRECTORY_SEPARATOR.'widgets');
		$fp = $this->file_open($dir.$file);
		$this->write_file($fp, $this->encrypt(array('settings'=>$settings, 'sidebars'=>$sidebars)));
		$this->file_close($fp);
	}
	
	function encrypt($data)
	{
		if(is_array($data)) return base64_encode(serialize($data));
		else return $data;
	}
	
	function decrypt($data)
	{
		$data = base64_decode($data);
		
		if(is_serialized($data)) return unserialize($data);
		else return $data;
	}
	
	function newdir($path, $mode = '0777', $recursive = false)
	{
		if(is_dir($path)) return $path.DIRECTORY_SEPARATOR;
		elseif( ! mkdir($path, $mode, $recursive)) wp_die( sprintf( __('System is not able to create backup directory, please create a directory named "backup" in "%s" manually and give it 0777 write permission.', THEME_NAME), $path));
		
		return $path.DIRECTORY_SEPARATOR;
	}
	
	function read_file($file)
	{
		if ( ! file_exists($file)) return FALSE;
		if(function_exists('file_get_contents')) return $this->decrypt(file_get_contents($file));
		if ( ! $fp = @fopen($file, 'rb')) return FALSE;
		flock($fp, LOCK_SH);
		$data = '';
		if(filesize($file) > 0)
		{
			$data =& fread($fp, filesize($file));
		}
		
		flock($fp, LOCK_UN);
		fclose($fp);
		return $this->decrypt($data);
	}
	
	function file_open($path, $mode = 'wb+')
	{
		if ( ! $fp = @fopen($path, $mode)) return FALSE;
		flock($fp, LOCK_EX);
		
		return $fp;
	}
	
	function write_file($fp, $data)
	{
		fwrite($fp, $this->encrypt($data));
	}
	
	function file_close($fp)
	{
		flock($fp, LOCK_UN);
		fclose($fp);
	}
		
	function pseudo($options = array())
	{
		foreach($options as $k=>$v)
		{
			if(is_array($v)) $options[$k] = $this->pseudo($v);
			elseif(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $v))
			{
				$options[$k] = '{ADMIN_EMAIL}';
			}
			else
			{
				$options[$k] = str_replace(array(get_template_directory_uri(), home_url(), get_option('admin_email')),array('{THEME_URL}', '{HOME_URL}', '{ADMIN_EMAIL}'),$v);
			}
		}
	
		return $options;
	}
	
	
	function replace_pseudo($options = array())
	{
		foreach((array)$options as $k=>$v)
		{
			if(is_array($v)) $options[$k] = $this->replace_pseudo($v);
			else
			{
				$options[$k] = str_replace(array('{THEME_URL}', '{HOME_URL}', '{ADMIN_EMAIL}'), array(get_template_directory_uri(), home_url(), get_option('admin_email')), $v);
			}
		}
	
		return $options;
	}
}