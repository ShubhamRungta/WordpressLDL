<?php
class SH_Options_timepicker extends SH_Options{	
	
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
		$this->atts = $this->extract_atts( sh_set( $field, 'attributes' ) );
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
		
		echo '<input type="text" id="'.$this->field['id'].'" '.$this->atts.' name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="'.$this->value.'" class="'.$class.' nhp-opts-timepicker" />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since SH_Options 1.0
	*/
	function enqueue(){
		wp_enqueue_style('nhp-opts-jquery-ui-css');
		wp_enqueue_style('dict-timepicker-addon', SH_FRW_URL.'theme_options/css/jquery-ui-timepicker-addon.css');
		wp_enqueue_script( 'nhp-opts-timepicker-addon', SH_FRW_URL.'theme_options/js/jquery-ui-timepicker-addon.js', array('jquery', 'jquery-ui-core', 'jquery-ui-slider', 'jquery-ui-datepicker'));
		wp_enqueue_script(
			'nhp-opts-field-timepicker-js', 
			SH_FRW_URL.'theme_options/fields/timepicker/field_timepicker.js', 
			'',
			time(),
			true
		);
		
	}//function
	
}//class
?>