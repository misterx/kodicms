<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

$plugin = Plugins_Item::factory( array(
	'id' => 'redirect',
	'title' => 'Redirect 301',
	'author' => 'ButscH',
	'description' => 'Provides an redirect to domain',
	'settings' => TRUE
) )
	->register();

if( $plugin->enabled() )
{
	if(!IS_BACKEND)
	{
		Observer::observe('frontpage_requested', 'redirect_to_domain');
		
		function redirect_to_domain()
		{
			$redirect = FALSE;
			$current_uri = $_SERVER['REQUEST_URI'];
			$path = $_SERVER['HTTP_HOST'] . $current_uri;
			$domain = Plugins_Settings::get_setting('domain', 'redirect');

			if($_SERVER['HTTP_HOST'] != $domain) 
			{
				$redirect = TRUE;
				$path = $domain . $current_uri;
			}

			if(Plugins_Settings::get_setting( 'check_url_suffix', 'redirect') == 'yes') 
			{
				if(
					strpos($path, URL_SUFFIX) === FALSE 
				AND 
					($current_uri != '/')
				) 
				{
					$redirect = TRUE;
					$path .= URL_SUFFIX;
				}
			}

			if($redirect === TRUE)
			{
				$protocol = Request::$initial->secure() ? 'https' : 'http';
				HTTP::redirect($protocol.'://' . $path, 301);
			}
		}
	}
}