<?php
class SH_Options_text extends SH_Options{	
	
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
		
		$class = (isset($this->field['class']))?$this->field['class']:'input-field';
		
		$name = isset( $this->field['name'] ) ? $this->field['name'] : $this->args['opt_name'].'['.$this->field['id'].']';
		//$placeholder = (isset($this->field['placeholder']))?' placeholder="'.esc_attr($this->field['placeholder']).'" ':'';
		
		echo '<input type="text" id="'.$this->field['id'].'" name="'.$name.'" '.$this->atts.'value="'.esc_attr(stripslashes($this->value)).'" class="'.$class.' text-input" />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
}//class
?>