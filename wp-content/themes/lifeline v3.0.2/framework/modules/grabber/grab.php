<?php

class SH_Grab
{
	var $res = '';
	var $source = '';
	
	function __construct($url = '')
	{
		include('config/config.php');
		$this->config = $options;
		$this->data = $data;
		//$url = 'http://vimeo.com/60037201';
		if( !$url ) return;

		if( $type = $this->get_type( $url ) )
		{
			//echo $type;exit;
			$this->source = $this->config[$type]['source'];
			$this->res = $this->get_data(rtrim($url, '/'), $type);
			//printr($this->res);exit;
			//$this->arrange($this->source, $data);
		}
	}
	
	/**
	 @param		string		$url	Link to grab the videos
	 @param		string		$type	URL type (video, playlist, channel)
	 @param		interger 	$number	Number of videos to grab
	 */
	function result($source = null, $data = null)
	{
		$data = (!$data) ? $this->res : $data;
		$source = (!$source) ? $this->source : $source;
		
		$array = (array)sh_set($this->data, $source);
		//printr($data);
		if( method_exists($this, $source) )	return $this->$source($data, $array);
		else return false;
	}
	
	function youtube($data, $array)
	{
		$return = array();
		$items = sh_set( sh_set($data, 'data'), 'items');
		
		if( $items )
		{
			foreach( $items as $k => $v )
			{
				foreach($array as $key => $val )
				{
					if( $key == 'thumb') $return[$k][$key] = sh_set( sh_set(sh_set($v, 'video'), 'thumbnail'), $val, $val );
					else $return[$k][$key] = sh_set( sh_set($v, 'video'), $val, $val );
				}
			}
		}elseif( is_object( $data ) ){
			$data = sh_set( $data, 'data');
			foreach($array as $key => $val )
			{
				if( $key == 'thumb') $return[$key] = sh_set( sh_set($data, 'thumbnail'), $val, $val );
				else $return[$key] = sh_set( $data, $val, $val );
			}
			$return = array($return);
		}

		return $return;
	}
	
	function vimeo($data, $array)
	{

		$return = array();
		foreach( $data as $k => $v )
		{
			foreach($array as $key => $val )
			{
				$return[$k][$key] = sh_set( $v, $val, $val );
			}
		}
		return $return;
	}
	
	function ustream($data, $array)
	{
		$return = array();
		$results = sh_set($data, 'results');
		if( is_array( $results ) )
		{
			foreach( (array)sh_set($data, 'results') as $k => $v )
			{
				foreach($array as $key => $val )
				{
					if( $key == 'thumb' ) $return[$k][$key] = sh_set( sh_set( $v, $val), 'medium');
					else $return[$k][$key] = sh_set( $v, $val, $val );
				}
			}
		}
		else
		{
			foreach($array as $key => $val )
			{
				if( $key == 'thumb' ) $return[0][$key] = sh_set( sh_set( $results, $val), 'medium');
				else $return[0][$key] = sh_set( $results, $val, $val );
			}
		}
		//printr($return);
		return $return;
	}
	
	function soundcloud($data, $array)
	{
		$return = array();//printr($data);
		if(is_array( $data ) )
		{
			foreach( $data as $k => $v )
			{
				//printr($array);
				foreach($array as $key => $val )
				{
					$return[$k][$key] = sh_set( $v, $val, $val );
				}
			}
		}else{
			foreach($array as $key => $val )
			{
				$return[0][$key] = sh_set( $data, $val, $val );
			}
		}
		//printr($return);
		return $return;
	}
	
	function dailymotion($data, $array)
	{
		$return = array();
//printr($data);
		if( is_array( sh_set( $data, 'list') ) )
		{
			foreach( sh_set( $data, 'list') as $k => $v )
			{
				foreach($array as $key => $val )
				{
					if( $key == 'tags' ) $return[$k][$key] = (is_array( sh_set( $v, $val))) ? implode(',', sh_set($v, $val)) : sh_set($v, $val);
					else $return[$k][$key] = sh_set( $v, $val, $val );
				}
			}
		}
		else
		{
			foreach($array as $key => $val )
			{
				if( $key == 'tags' ) $return[0][$key] = (is_array( sh_set( $data, $val))) ? implode(',', sh_set($data, $val)) : sh_set($data, $val);
				else $return[0][$key] = sh_set( $data, $val, $val );
			}
		}
		//printr($return);
		return $return;
	}
	
	function blip($data, $array)
	{
		$return = array();
		
		$post = sh_set( sh_set( $data, '0'), 'Post');
//printr($data);
		if( ! $post )
		{
			foreach( $data as $k => $v )
			{
				foreach($array as $key => $val )
				{
					if( $key == 'tags' && is_array ( sh_set($v, $val) ) ) {
						$tags = '';
						foreach( (array)sh_set($v, $val) as $tag)
							$tags .= sh_set( $tag, 'name').', ';
						
						$return[$k][$key] = $tags;
					}
					elseif( $key == 'duration' ) $return[$k][$key] = sh_set( sh_set($v, 'media'), $val);
					else $return[$k][$key] = sh_set( $v, $val, $val );
				}
			}
		}
		else
		{
			foreach($array as $key => $val )
			{
				if( $key == 'tags' && is_array ( sh_set($post, $val) ) ) {
					$tags = '';
					foreach( (array)sh_set($post, $val) as $tag)
						$tags .= sh_set( $tag, 'name').', ';
					
					$return[0][$key] = $tags;
				}
				elseif( $key == 'duration' ) $return[0][$key] = sh_set( sh_set($post, 'media'), $val);
				else $return[0][$key] = sh_set( $post, $val, $val );
			}
		}
		//printr($return);
		return $return;
	}
	
	function metacafe($data, $array)
	{
		$return = array();
		
		$post = sh_set( sh_set( $data, '0'), 'Post');
		$item = sh_set( sh_set($data, 'channel'), 'item');

		if( $item )
		{
			$item = is_array( $item ) ? $item : array($item);
			foreach( $item as $k => $v )
			{
				$v = (array)$v;
				foreach($array as $key => $val )
				{
					$return[$k][$key] = sh_set( $v, $val, $val );
				}
			}
		}
		else return false;
		//printr($return);
		return $return;
	}
	
	function get_id($url, $type)
	{
		
		if( isset($this->config[$type]) )
		{
			preg_match($this->config[$type]['regex'], $url, $matches);
			
			if( isset($matches[0]) ) return $matches[0];
			else return false;
		}
	}
	
	function fetch_links($id, $type)
	{
		if( isset($this->config[$type]) ) return str_replace('{id}', $id, $this->config[$type]['link']);
		else return false;		
	}
	
	function get_data($url, $type)
	{
//echo $type;exit;		
		$id = $this->get_id($url, $type);
//echo $this->source;exit;		
//echo $id;exit;
		$link = '';
		if($id) $link = $this->fetch_links($id, $type);
		else return false;
//echo $type;exit;
//echo $link;exit;
		//$data = @file_get_contents($link);//echo $data;exit;
		//printr($this->json_decodes($data));
		if( !function_exists('curl_init') ){
			$data = @file_get_contents($link);//echo $data;exit;
		}else{
			$ch = curl_init($link);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux i686; rv:20.0) Gecko/20121230 Firefox/20.0');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			$data = curl_exec($ch);
			curl_close($ch);
		}
		//printr($data);
		
		return $this->json_decodes($data);
	}
	
	function get_type($url)
	{
		//printr($this->config);
		foreach($this->config as $k => $v )
		{
			preg_match($v['type'], $url, $matches);
			if( $matches ) return $k;
		}
		return false;
	}
	
	function json_decodes($str)
	{
		$data = json_decode( (string)$str);
		if( !$data )
		{
			$replace = str_replace( "blip_ws_results([[{", "[{", $str, $replaced_count );
            if($replaced_count > 0) {
                $replace = str_replace( "]);", "", $replace );
            }
            else
            {
                $replace = str_replace( "blip_ws_results([{", "[{", $replace, $replaced_count );
                $replace = str_replace( "]);", "]", $replace );
            }

			$data = json_decode( (string)$replace, true);
			if( !$data ) $data = simplexml_load_string($str);
		}
		
		return $data;
	}
}