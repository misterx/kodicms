<?php defined('SYSPATH') or die('No direct access allowed.');class Controller_Plugins extends Controller_System_Backend{		public function action_index()	{		$this->template->content = View::factory('plugins/index', array(			'plugins' => Plugins::find_all(),			'loaded_plugins' => Plugins::get_loaded()		));				$this->template->title = __('Plugins');		$this->breadcrumbs			->add($this->template->title, 'plugins');	}		public function action_status()	{		$status = (int) Arr::get( $_POST, 'status' );		$plugin_id = Arr::get( $_POST, 'id' );		Plugins::find_all();		$plugin = Plugins::get_registered( $plugin_id );		$view = $status == 1 ? 'activated' : 'deactivated';		if ( $status )		{			Plugins::activate( $plugin_id );		}		else		{			Plugins::deactivate( $plugin_id );		}		Kohana::cache('Database::cache(plugins_list)', NULL, -1);		$this->json['status'] = TRUE;		$this->json['operation'] = $view;		$this->json['plugin_id'] = $plugin_id;		$this->json['javascripts'] = $plugin->javascripts();		$this->json['styles'] = $plugin->styles();		$this->json['html'] = (string) View::factory( 'plugins/status/' . $view, array(			'id' => $plugin_id,			'plugin' => $plugin		) );	}	} // end class PluginsController