<?php
class SH_Options_modules extends SH_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since SH_Options 1.0.5
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
	 * @since SH_Options 1.0.5
	*/
	function render(){
		
		$class = (isset($this->field['class']))?$this->field['class']:'regular-text';

		echo '<ul class="module-sortable" id="'.$this->field['id'].'-ul">';
		
		$opt = sh_set( $this->field, 'options' );
		$options = ($this->value) ? $this->value : $opt; 
		$count = 0;
		$name = $this->args['opt_name'].'['.$this->field['id'].']';
		foreach( $options as $k => $v ){
			
			$value = is_array( $v ) ? $v : array( $k => $v );

			$true = ( sh_set( $value, $k.'_status' ) == 'true' ) ? 'true' : 'false';
			echo '<li data-id="'.$k.'">
						<span class="title">'.sh_set($opt, $k).'</span>
						<input type="hidden" name="'.$name.'['.$k.']['.$k.']" value="'.$k.'" />
						
						<input type="hidden" id="'.$this->field['id'].'_'.$k.'" name="'.$name.'['.$k.']['.$k.'_status]"  value="'.$true.'" />			
						<div class="bool-slider '.$true.'" data-id="'.$this->field['id'].'_'.$k.'" >
							<div class="inset">
								<div class="control"></div>
							</div>
						</div>
				 </li>';
			$count++;
		}		
		
		echo '</ul>';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since SH_Options 1.0.5
	*/
	function enqueue(){
		
		wp_enqueue_script(
			'nhp-opts-field-multi-text-js', 
			SH_FRW_URL.'theme_options/fields/modules/field_modules.js', 
			array('jquery', 'jquery-ui-sortable'),
			time(),
			true
		);
		
	}//function
	
}//class
?>