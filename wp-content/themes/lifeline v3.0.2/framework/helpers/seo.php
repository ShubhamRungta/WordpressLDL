<?php
class SH_Seo
{

	private $options = '' ;
	private $meta_info = '' ;
	private $posttype = '';
	
	function __construct()
	{
		if(is_admin()) return ;
		global $wp_query ;
		global $post_type;
		add_action( 'wp_title', array( $this, 'sh_meta_title' ) );
		add_action( 'wp_head', array( $this, 'sh_wp_head' ), 5 );
		$this->posttype =  $post_type ;
		$this->options = get_option(SH_NAME);
		$this->meta_info = get_post_meta(sh_set(get_queried_object() , 'ID') , '_'.$this->posttype.'_settings');
		
	}
	function sh_meta_title($title)
	{
		global $wp_query; 
		global $post ;
		$meta = get_post_meta(sh_set($post , 'ID') , '_'.sh_set($post , 'post_type').'_settings');
		$s_post = array('post');
			$check_post = ( sh_set($this->options , 'sh_post_types_seo') ) ? sh_set($this->options , 'sh_post_types_seo') : $s_post;
		if(sh_set($this->options , 'sh_seo_status')) 
		{
			if(is_home() || is_front_page() || $wp_query->is_posts_page)
			{
				$title = (sh_set($this->options , 'homepage_meta_title')) ? sh_set($this->options , 'homepage_meta_title') :$title ;
			}
			elseif(is_singular(sh_set($post , 'post_type')) and in_array( sh_set( $post , 'post_type') , $check_post) and sh_woo_pages( get_the_ID() == 'false' ))
			{
				$title = (sh_set(sh_set($meta , 0) , 'meta_title')) ? sh_set(sh_set($meta , 0) , 'meta_title') : $title;
			}
			else
			{
				if(sh_set($this->options , 'seperator') && sh_set($this->options , 'title_setting'))
				$title .= ' '.sh_set($this->options , 'seperator').' '. get_bloginfo(sh_set($this->options , 'title_setting')); 
				else
				$title = $title ;
			}
		}
		return $title ; 		
	}
	function sh_wp_head()
	{
		if(sh_set($this->options , 'sh_seo_status')) 
		{
			global $wp_query; 
			global $post ;
			$meta = get_post_meta(sh_set($post , 'ID') , '_'.sh_set($post , 'post_type').'_settings');
			
			$s_post = array('post');
			$check_post = ( sh_set($this->options , 'sh_post_types_seo') ) ? sh_set($this->options , 'sh_post_types_seo') : $s_post;
			if( is_home() || is_front_page() || $wp_query->is_posts_page )
			{
				echo "\n".'<meta name="description" content="'.sh_set($this->options , 'homepage_meta_desc').'"/> '."\n";
				echo  '<meta name="keywords" content="'.sh_set($this->options , 'homepage_meta_keywords').'"/>'."\n" ;
			}
			elseif(is_singular(sh_set($post , 'post_type')) and in_array( sh_set( $post , 'post_type') , $check_post) and sh_woo_pages( get_the_ID() == 'false' ))
			{
				echo "\n".'<meta name="description" content="'.sh_set(sh_set($meta , 0) , 'meta_desc').'"/>'."\n"; 
				echo  '<meta name="keywords" content="'.sh_set(sh_set($meta , 0) , 'meta_keywords').'"/>'."\n" ;
			}
		}

	}
}