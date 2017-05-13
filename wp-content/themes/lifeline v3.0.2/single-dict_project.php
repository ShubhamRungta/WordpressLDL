<?php 
sh_custom_header();
$Settings = get_option(SH_NAME); 
$PostSettings = get_post_meta( get_the_ID(), '_'.sh_set($post, 'post_type').'_settings', true);
$attachments = get_posts(array('post_type'=>'attachment', 'post_parent'=>get_the_ID() , 'showposts' => -1) );
$sidebar = sh_set( $PostSettings, 'sidebar') ? sh_set( $PostSettings, 'sidebar' ) : '';
$column = ($sidebar) ? 'nine-column':'twelve-column';
$paypal = $GLOBALS['_sh_base']->donation;
$percent = (sh_set( $PostSettings, 'amount_needed' )) ? (int)str_replace(',', '', sh_set( $PostSettings, 'spent_amount' )) / (int)str_replace(',', '', sh_set( $PostSettings, 'amount_needed' )) : 0;
$donation_percentage = round($percent*100, 2);

$symbol = (sh_set( $PostSettings, 'spent_amount_currency' )) ? sh_set( $PostSettings, 'spent_amount_currency' ) : '$';
$sh_currency_code = (sh_set( $PostSettings, 'currency_code' )) ? sh_set( $PostSettings, 'currency_code' ) : 'USD';
$_SESSION['sh_causes_id'] = get_the_ID();
$_SESSION['sh_causes_url'] = get_permalink();
$_SESSION['sh_causes_page']=true;
$_SESSION['sh_currency_code'] = $sh_currency_code;
$_SESSION['sh_donation_needed'] = sh_set($PostSettings , 'amount_needed');
$_SESSION['sh_donation_collected'] = sh_set($PostSettings , 'spent_amount');
$_SESSION['sh_currency_symbol'] = $symbol;
$_SESSION['sh_post_type'] = 'project';
$paypal_res = '';
if(isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return'){
	$paypal_res =require_once(get_template_directory().'/framework/modules/pp_recurring/review.php');
	
}
if( $notif = $paypal->_paypal->handleNotification() ) $paypal_res = $paypal->single_pament_result($notif);
?>
<div class="top-image"><img src="<?php echo sh_set($PostSettings , 'top_image'); ?>" alt="" /></div>
<!-- Page Top Image -->
<section class="inner-page<?php echo ( sh_set( $PostSettings, 'sidebar_pos' ) == 'left' ) ? ' switch': '';?>">
    <div class="container">
		<div class="left-content <?php echo $column?>">
			<div  id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
            	<?php while( have_posts() ): the_post();?>
                	<?php the_post_thumbnail('1170x455'); ?>
                    <span class="category"><?php _e('In ', SH_NAME); ?> <?php echo get_the_term_list( get_the_ID(), 'project_category' , '' , ',' ,'' ) ?> </span><!-- Categories -->
                    <h1><?php the_title(); ?></h1>
                    
                    <ul class="post-meta">
                    
                        <li><a href="" title=""><i class="icon-calendar-empty"></i><span><?php echo get_the_date( 'm-d-y', get_the_id() );?></a></li>
                        <?php 
						$Author = get_the_author();
						if( !empty( $Author ) ) :?>
                        
                            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title=""><i class="icon-user"></i><?php echo _e( 'By', SH_NAME );?> <?php echo get_the_author();?></a></li>
                        <?php endif;?>
                        <?php if( sh_set( $PostSettings, 'location' ) ) :?>
                        
                            <li><a href="" title=""><i class="icon-map-marker"></i><?php echo __( 'In', SH_NAME ).' '.sh_set( $PostSettings, 'location' );?></a></li>
                        <?php endif;?>
                        <li>
                            <p><span><?php echo sh_set( $PostSettings, 'amount_needed_currency' );?></span> <?php echo sh_set( $PostSettings, 'amount_needed' );?></p>
                           <?php if(sh_set($Settings , 'donate_method') == 'true') :?>		   
									<span data-toggle="modal" data-target="#myModal"  class="donate-btn"><?php _e('Donate Us', SH_NAME)?></span>
							<?php else:?>
									<span><?php echo $paypal->button(array('currency_code'=>$sh_currency_code,'item_name'=>get_bloginfo('name'), 'return'=>get_permalink()));?></span>
							
							<?php endif;?>
                        </li>
                    </ul>
                    
                    <div class="post-desc">
                     
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <?php 
                            if(isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return'){?>
                    
                                <div class="donate-popup"><?php echo $paypal_res;?></div>
                                
                                <script>
                                    jQuery(document).ready(function($){
                                        $(".post-meta .donate-btn").trigger("click");
                                    
                                    });
                                </script>
                
                    
                        <?php }
                            elseif($notif = $paypal->_paypal->handleNotification() && isset($notif->ok)){?>
                                <div class="donate-popup"><?php $paypal_res;?></div>
                    
                                    <script>
                                            jQuery(document).ready(function($){
                                                $(".post-meta .donate-btn").trigger("click");
                                            
                                            });
                                    </script>
                        <?php }
                            else{?>
                            <div class="donate-popup">
                                <div class="cause-bar">
                                    <div class="cause-box"><h3><span><?php echo $symbol;?></span><?php echo sh_set( $PostSettings, 'amount_needed' );?></h3><i><?php _e('NEEDED DONATION', SH_NAME);?></i></div>
                                    <div class="cause-progress">
                                            <div class="progress-report">
                                            <h6><?php _e('PHASES', SH_NAME); ?></h6>
                                            <span><?php echo $donation_percentage;?>%</span>
                                            <div class="progress pattern">
                                                <div class="progress-bar" style="width:<?php echo $donation_percentage?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cause-box"><h3><span><?php echo $symbol;?></span><?php echo sh_set( $PostSettings, 'spent_amount' );?></h3><i><?php _e('COLLECTED DONATION', SH_NAME);?></i></div>
                                    <div class="cause-box donate-drop-btn"><h4><?php _e('DONATE NOW', SH_NAME);?></h4></div>
                                </div>
                                <?php 
									$Settings = get_option(SH_NAME); 
									$value = sh_set($Settings , 'transactions_detail');
								?>
                                <div class="donate-drop-down">
                                    <div class="recursive-periods">
                                       <?php
									   	if($value)
										{
											foreach($value as $val )
											{
												$txt = ucwords(str_replace('_', ' ', $val));
												$output .= '<a style="cursor:pointer;">'.__( $txt, SH_NAME ).'</a>';
											}
										}
                                       ?>
                                    </div>
                                    <div class="amount-btns">
                                        <?php 
											if( intval ( sh_set($Settings , 'pop_up_1st_value') ) != '') echo '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_1st_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_2nd_value') ) != '') echo '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_2nd_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_3rd_value') ) != '') echo '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_3rd_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_4th_value') ) != '') echo '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_4th_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_5th_value') ) != '') echo '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_5th_value').'</span></a>';
										?>
                                    </div>
                                    
                               
                                    <div class="other-amount">
                                           <?php echo $paypal->button(array('currency_code'=>$sh_currency_code,'item_name'=>get_bloginfo('name'), 'amount'=>30, 'return'=>get_permalink()));?>
                                    </div>
                                    
                                    
                                   <?php  if(!is_user_logged_in()){?>
                                        <form id="login" action="" method="post">
                                                <h1><?php _e('Please Login OR Register first to make recursive donation', SH_NAME);?></h1>
                                                <p class="status"></p>
                                                <label for="username"><?php _e('Username', SH_NAME);?></label>
                                                <input id="username" type="text" name="username">
                                                <label for="password"><?php _e('Password', SH_NAME);?></label>
                                                <input id="password" type="password" name="password">
                                                <a class="lost" href="<?php wp_registration_url();?>"><?php _e('Register Now', SH_NAME);?></a>
                                                <input class="submit_button" type="submit" value="<?php _e('Login', SH_NAME)?>" name="submit">
                                                <a class="close" href="">(close)</a>
                                                <?php wp_nonce_field( 'ajax-login-nonce', 'security' )?>
                                            </form>
                                   <?php  }?>
                                </div>
                            </div>
                        <?php }?>
                        </div>
                    	<p><?php the_content(); ?></p></div>
                    
                        <div class="cloud-tags">
                            <?php the_tags('<h3 class="sub-head">'.__('Tags Clouds', SH_NAME).'</h3>', ''); ?>
                        </div><!-- Tags -->	

                     <?php if( sh_set( $Settings, 'page_comments_status' ) == 'true' ): ?> 
                        <div class="comments"><?php comments_template();?></div>
                     <?php endif;?>
                     
                <?php endwhile;?>
			</div>
		</div>
		<div class="sidebar three-column pull-left">
        	<?php dynamic_sidebar( $sidebar ); ?>
		</div>
	</div>
</section> 
<?php get_footer(); ?>