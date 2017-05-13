<?php 

class SH_Meta_boxes
{
	
	var $_fields = '';
	
	
	function __construct()
	{
		//include(get_template_directory().'/includes/resource/awesom_icons.php');
		$GLOBALS['_font_awesome'] = '';//$awesome_icons;
		
		add_action( 'admin_init', array( $this, 'add_metabox' ) );
		add_action('admin_enqueue_scripts', array($this, 'enqueue') );
		add_action( 'save_post', array( $this, 'publish_post' ) );
		
		
	}
	
	function enqueue()
	{
		wp_register_script('jquery-select2', SH_FRW_URL.'resource/js/jquery.select2.min.js');
		
		wp_register_style('jquery-ui-datepicker-custom', SH_FRW_URL.'resource/css/jquery.ui.all.css');
		wp_register_style('admin-custom-styles', SH_FRW_URL.'resource/css/style.css');
	}
	
	function add_metabox()
	{
		
		include(SH_FRW_DIR.'resource/settings.php');
		$this->_fields = $settings;
		$keys = array_keys( $this->_fields );
		
		$options = get_option(SH_NAME);

		foreach( $keys as $k ){
			$sections = sh_set($settings , $k);
			foreach($sections as $key =>$section):
			$position = sh_set($section , 'position');
			$section_id = sh_set($section , 'section_id');
			$s_post = array('post');
			$selected_post_types = ( sh_set($options , 'sh_post_types_seo') )? sh_set($options , 'sh_post_types_seo'): $s_post;
			if($section_id == 'seo_settings')
			{
				if(sh_set($options , 'sh_seo_status') && in_array($k , $selected_post_types))
				{
					add_meta_box($k.'_settings_'.$key, sprintf(__( '%s', SH_NAME ), ucwords(sh_set($section , 'section_name'))), array( $this, 'inner_custom_box'), $k , $position , 'low' , $section );
				}
			}
			else
			{
				add_meta_box($k.'_settings_'.$key, sprintf(__( '%s', SH_NAME ), ucwords(sh_set($section , 'section_name'))), array( $this, 'inner_custom_box'), $k , $position , 'low' , $section );
			}
			endforeach ;
		}
	}
	
	function inner_custom_box($post , $metabox)
	{
		wp_enqueue_style(array('jquery-ui-datepicker-custom', 'admin-custom-styles'));
		wp_enqueue_script(array('jquery-ui-datepicker', 'jquery-select2'));
		$t = &$GLOBALS['_sh_base'];
		$post_type = sh_set( $post, 'post_type');
		
		$settings = get_post_meta( sh_set($post, 'ID' ), '_'.$post_type.'_settings', true);
		
		$fields = $metabox['args']['fields'];
		$nph = new SH_Options;
		$nph->args['opt_name'] = $post_type;
		if( $fields && is_array( $fields ) ): ?>
        	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.fields_set select').select2();
				if( $('#start_date') ){
					//$('#start_date, #end_date').datepicker();
				}
			});
			</script>

			<?php foreach( $fields as $f): ?>
				
                <div class="fields_set" >
                	<label><strong><?php echo sh_set( $f, 'title'); ?></strong></label>
                    <div class="field">
                    	<?php echo $nph->_field_input($f, sh_set($settings, sh_set( $f, 'id' )) ); 	?>
                    </div>
                    <span> <?php echo sh_set( $f, 'help');  ?> </span>
                </div>
            <?php endforeach;
		endif;
	}
	
	
	function _html()
	{
	}
	
	function publish_post($post_id)
	{
		global $post;
		$post_type = sh_set( $_POST, 'post_type' );
		$setting = sh_set($this->_fields, $post_type);
		
		$types = array_merge(array('post', 'page'), (array)array_keys( (array) $this->_fields )); 
		if( !in_array($post_type , $types) ) return;
		
		$data = sh_set( $_POST, $post_type);//array_intersect_key( $_POST, $setting);
		if( !$data ) return;
		//printr($post);
		if( $post_type == 'dict_event') update_post_meta( $post_id, '_dict_event_date', sh_set( $data, 'start_date'));
		update_post_meta( $post_id, '_'.$post_type.'_settings', $data );
	}
}