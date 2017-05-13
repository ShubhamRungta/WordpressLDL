<div id="<?php echo $id; ?>" class="tab_content" style="display:none;">
<div class="content">
    <div class="box">
        <h1><?php echo $section_title; ?></h1>
        <div class="box-content">
        
        	<?php foreach( $fields as $f ): //printr($f); 
		
			?>
            
                <?php $show_title = sh_set( sh_set($f, 'settings'), 'hide_title'); ?>
                 <?php if(isset($f['dependent'])): ?> <div id="<?php echo $f['dependent'] ; ?>" class="desc_dependent"> <?php endif ; ?>
                <div class="opt-bar">
					
					<?php if( sh_set( $f, 'type' ) == 'heading' ): ?>
                        <?php $this->_field_input( $f ); ?>
                    <?php else: ?>
                		 
                       <?php if( !$show_title ): ?>
                        
                            <div class="left">
                                
                                <h2><?php echo sh_set( $f, 'title' ); ?></h2>
                                
                                <?php if( sh_set( $f, 'desc' ) ): ?>
                                    <span class="mark">? <span class="tooltip"><?php echo sh_set( $f, 'desc' ); ?></span> </span>
                                <?php endif; ?>
                                
                            </div>
                        
                        <?php endif; ?>
                        
                        <div class="<?php echo ($show_title) ? 'choose-style' : 'right'; ?>">
                        
                        	<?php 
							/*if(isset($f['dependent'])){ 
								$opt_values = array();
								foreach($fields as $dep)
								{
									$opt_values = (in_array($f['dependent'] , $dep))? $dep['options'] : '' ; 
									if($opt_values != '') break ; 
								}
							}*/
							
							if( sh_set( $f, 'fields' ) ): ?>
                            		<?php foreach( sh_set( $f, 'fields' ) as $new_f ): ?>
                                    	<div class="blocks">
                                            <h4><?php echo sh_set( $new_f, 'title' ); ?></h4>
                                           
                                            <?php $this->_field_input( $new_f ); ?>
                                        
                                        </div>
                                    <?php endforeach; ?>
                            <?php else: ?>
                            
                          
                            	<?php $this->_field_input( $f ); ?>
                             
                            <?php endif; ?>
                    	</div>
                <?php endif; ?>
                
                </div>
                <?php if(isset($f['dependent'])): ?> </div><?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>
</div>
