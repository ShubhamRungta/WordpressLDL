<?php
class SH_Options_multi_group extends SH_Options{	
	
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
		//printr($this->field);
		echo '<ul id="'.$this->field['id'].'-ul" class="multigroup">';

		
		if(isset($this->value) && is_array($this->value)){
			$count = 0;
			foreach($this->value as $k => $value){
				
				if($value != ''){
				
					echo '<li>'.$this->generate($value, $count, false).'<a href="javascript:void(0);" class="nhp-opts-multi-fields-remove button-secondary">'.__('Remove Row', SH_NAME).'</a></li>';
					//echo '<li><input type="text" id="'.$this->field['id'].'-'.$k.'" name="'.$this->args['opt_name'].'['.$this->field['id'].'][]" value="'.esc_attr($value).'" class="'.$class.'" /> <a href="javascript:void(0);" class="nhp-opts-multi-text-remove">'.__('Remove', 'nhp-opts').'</a></li>';
					
				}//if
				$count++;
			}//foreach
		}else{

			echo '<li>'.$this->generate(array(), 0, false).'<a href="javascript:void(0);" class="nhp-opts-multi-fields-remove button-secondary">'.__('Remove Row', SH_NAME).'</a></li>';
			//echo '<li><input type="text" id="'.$this->field['id'].'" name="'.$this->args['opt_name'].'['.$this->field['id'].'][]" value="" class="'.$class.'" /> <a href="javascript:void(0);" class="nhp-opts-multi-text-remove">'.__('Remove', 'nhp-opts').'</a></li>';
		
		}//if
		
		echo '<li style="display:none;" class="append_multi_field">'.$this->generate().'<a href="javascript:void(0);" class="nhp-opts-multi-fields-remove button-secondary">'.__('Remove Row', SH_NAME).'</a></li>';
		//echo '<li style="display:none;"><input type="text" id="'.$this->field['id'].'" name="" value="" class="'.$class.'" /> <a href="javascript:void(0);" class="nhp-opts-multi-text-remove">'.__('Remove', 'nhp-opts').'</a></li>';
		
		echo '</ul>';
		
		echo '<a href="javascript:void(0);" class="nhp-opts-multi-fields-add" rel-id="'.$this->field['id'].'-ul" rel-name="'.$this->args['opt_name'].'['.$this->field['id'].'][]">'.__('Add More', 'nhp-opts').'</a><br/>';
		
		//echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
	
	function generate( $value = '', $i = 0, $def = true )
	{

		if( isset( $this->field['field'] ) )
		{
			$content = '';
			$i = ( $def ) ? '%s' : $i;
			foreach( $this->field['field'] as $f ){
				$val = isset( $value[$f['id']] ) ? $value[$f['id']] : '';
				$f['name'] = $this->args['opt_name'].'['.$this->field['id'].']['.$i.']['.$f['id'].']';
				$f['id'] = $f['id'].'_'.$i;
				ob_start();
				echo '<div class="field blocks"><label>'.$f['title'].': </label>';
				$this->_field_input( $f, $val );
				echo '</div>';
				$content .= ob_get_contents();
				ob_end_clean();
			}
			$content .= '<div class="clear"></div>';
			return $content;
		}

	}
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since SH_Options 1.0.5
	*/
	function enqueue(){
		
		wp_enqueue_script(
			'nhp-opts-field-multi-group-js', 
			SH_FRW_URL.'theme_options/fields/multi_group/field_multi_group.js', 
			array('jquery'),
			time(),
			true
		);
		
	}//function
	
}//class
?>