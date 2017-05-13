<?php
// windows-proof constants: replace backward by forward slashes - thanks to: https://github.com/peterbouwmeester
$fr_dir = get_template_directory_uri().'/framework/';
$fr_abs = get_template_directory().'/framework/';
if(!defined('SH_FRW_DIR')){
	define('SH_FRW_DIR', $fr_abs);
}
if(!defined('SH_FRW_URL')){
	define('SH_FRW_URL', $fr_dir);
}
if(!defined('SH_Options_URL')){
	define('SH_Options_URL', $fr_dir);
}
if(!defined('SH_THEME_NAME')){
define('SH_THEME_NAME', $fr_dir);
}
function sh_get_rev_slider()
{
	global $wpdb;
	$res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."revslider_sliders");
	$return = array();
	if( $res ){
		foreach( $res as $r )
		{
			$return[sh_set( $r, 'alias' )] = sh_set( $r, 'title' );
		}
	}
	return $return;
}
function sh_set( $var, $key, $def = '' )
{
	if( !$var ) return false;
	if( is_object( $var ) && isset( $var->$key ) ) return $var->$key;
	elseif( is_array( $var ) && isset( $var[$key] ) ) return $var[$key];
	elseif( $def ) return $def;
	else return false;
}
function sh_character_limit( $Limit, $Text )

{
	return ( strlen( $Text ) > $Limit ) ? substr( $Text, 0, $Limit ).'<small>...</small>': $Text;
}
function sh_get_title( $Title, $TitleTag, $SubTitleTag, $IsFirstWordInSubTitleTag = TRUE )

{
	if( strpos( $Title, ' ' ) !== FALSE )
	{
		$FirstWord = explode( ' ', $Title );
		$RestOfTitle = str_replace( $FirstWord[0], '', $Title );
		$FirstWordBefore = ( $IsFirstWordInSubTitleTag !== FALSE ) ? '<'.$SubTitleTag.'>': '';
		$FirstWordAfert = ( $IsFirstWordInSubTitleTag !== FALSE ) ? '</'.$SubTitleTag.'> ': ' <'.$SubTitleTag.'>';
		$RestOfTitleAfter = ( $IsFirstWordInSubTitleTag === FALSE ) ? '</'.$SubTitleTag.'>': '';
		return '<'.$TitleTag.'>'.$FirstWordBefore.$FirstWord[0].$FirstWordAfert.$RestOfTitle.$RestOfTitleAfter.'</'.$TitleTag.'>';
	}
	else return '<'.$TitleTag.'><'.$SubTitleTag.'>'.$Title.'</'.$SubTitleTag.'></'.$TitleTag.'>';
}

function sh_get_post_types()
{
	$PostTypes = array( 
						'post' => 'Post',
						'page' => 'Page',
						'dict_testimonials' => 'Testimonials',
						'dict_causes' => 'Causes',
						'dict_project' => 'Projects',
						'dict_event' => 'Event',
						'dict_portfolio' => 'Portfolio',
						'dict_gallery' => 'Gallery',
						'dict_team' => 'Team',
						'dict_services' => 'Services',
					  );

	return $PostTypes;

}
function printr($data)
{
	echo '<pre>'; print_r($data);exit;
}
function _font_awesome( $index )
{
	$array = array_values($GLOBALS['_font_awesome']);
	if( $font = sh_set($array, $index )) return $font;
	else return false;
}
function _load_class($class, $directory = 'libraries', $global = true, $prefix = 'SH_')
{
	$obj = &$GLOBALS['_sh_base'];
	$obj = is_object( $obj ) ? $obj : new stdClass;
	$name = FALSE;
	// Is the request a class extension?  If so we load it too
	$path = SH_FRW_DIR.$directory.'/'.$class.'.php';
	if( file_exists($path) )
	{
		$name = $prefix.ucwords( $class );
		if (class_exists($name) === FALSE) {
			require($path);
		}
	}
	// Did we find the class?
	if ($name === FALSE) exit('Unable to locate the specified class: '.$class.'.php');
	if( $global ) $GLOBALS['_sh_base']->$class = new $name();
	else new $name();
}
get_template_part( 'framework/theme_options' );
get_template_part('framework/library/form_helper');
get_template_part('framework/library/functions');
get_template_part('framework/library/widgets');
get_template_part('framework/helpers/codebird');
get_template_part('framework/helpers/taxonomies');
get_template_part('framework/modules/grabber/grab');

_load_class('enqueue', 'helpers', false);
_load_class('seo', 'helpers', false);
_load_class( 'post_types', 'helpers', false );
_load_class( 'meta_boxes', 'helpers', false );
_load_class( 'taxonomies', 'helpers', false );
_load_class( 'ajax', 'helpers', false );
_load_class( 'shortcodes', 'helpers', false );
_load_class( 'donation', 'helpers' );
_load_class( 'megamenu_walker', 'helpers', false );
_load_class( 'codebird', 'helpers' , false);
if( sh_set( $_GET, 'sh_shortcode_editor_action' ) ) {
	get_template_part('framework/resource/shortcode_output');exit;
}
if( function_exists('vc_map') ) get_template_part( 'framework/vc_map' );
if( is_admin() ) {
	/** Plugin Activation */
	require_once(get_template_directory().DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'tgm-plugin-activation'.DIRECTORY_SEPARATOR.'plugins.php');
	if( sh_set($_GET, 'page') == 'sh_theme_options' && sh_set($_GET, 'data') == true)
	{
		_load_class('import_export', 'helpers');
		$GLOBALS['_sh_base']->import_export->export();
	}
	/*if( sh_set($_GET, 'page') == 'sh_theme_options' && sh_set($_GET, 'theme_settings_import') == true)
	{
		_load_class('import_export', 'helpers');
		$GLOBALS['_sh_base']->import_export->import();
	}*/
	
	/*if( sh_set($_GET, 'page') == 'sh_theme_options' && sh_set($_GET, 'xml') == true)
	{
		include('helpers/importer.php');
		sh_xml_importer();
	}*/
}