<?php
class SH_Options_button_set extends SH_Options{	
	
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
		
		$class = (isset($this->field['class']))?'class="'.$this->field['class'].'" ':'';

		$name = isset( $this->field['name'] ) ? $this->field['name'] : $this->args['opt_name'].'['.$this->field['id'].']';

		$true = ( $this->value == 'true' ) ? 'on' : 'off';
		$on = ( $this->value == 'true' ) ? 'on' : '';
		echo '<div class="midAlign-settings">           
				  <div class="slider-frame">
					<span data-id="'.$this->field['id'].'" class="slider-button '.$on.'">'.$true.'</span>
				  </div>
				</div>';
		
		echo '<input type="hidden" id="'.$this->field['id'].'" name="'.$name.'" '.$class.' value="'.$this->value.'" />';
		
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

		wp_enqueue_script(
			'sh-opts-field-button_set-js', 
			SH_FRW_URL.'theme_options/fields/button_set/field_button_set.js', 
			array('jquery', 'jquery-ui-core', 'jquery-ui-dialog'),
			time(),
			true
		);

		
	}//function
	
}//class
?>