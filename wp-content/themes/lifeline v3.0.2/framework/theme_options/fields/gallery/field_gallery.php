<?php
class SH_Options_gallery extends SH_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since SH_Options 1.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since SH_Options 1.0
	*/
	function render(){
		
		$class = (isset($this->field['class']))?$this->field['class']:'';

		echo '<div class="farb-popup-wrapper">';
		
		echo '<div id="media_images">'.$this->get_attachments($this->value).'</div>';
		echo '<input type="text" id="'.$this->field['id'].'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="'.$this->value.'" class="'.$class.'" />';
		echo '<a title="'.__('Add Media', SH_NAME).'" data-editor="dict_gallery[gallery]" class="button sh_media_button" href="#"><span class="wp-media-buttons-icon"></span> '.__('Add Media', SH_NAME).'</a>';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
		echo '</div>';
		
	}//function
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since SH_Options 1.0
	*/
	function enqueue(){
		
		wp_enqueue_script(
			'nhp-opts-field-gallery-js', 
			SH_FRW_URL.'theme_options/fields/gallery/field_gallery.js', 
			array('jquery'),
			time(),
			true
		);
		
	}//function
	
	function get_attachments( $str = '' )
	{
		if( !$str ) return '';
		
		$attachments = get_posts('post_type=attachment&include='.$str);//printr($attachments);
		$return = '';
		if( $attachments ){
			foreach( $attachments as $att ){
				$src = wp_get_attachment_image_src($att->ID, 'thumbnail');
				$return .= '<p><img src="'.sh_set($src, '0').'" /><a href="#" data-id="'.$att->ID.'">x</a></p>';
			}
		}
		return $return;
	}
	
}//class
?>