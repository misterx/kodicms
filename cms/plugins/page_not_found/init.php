<?php defined('SYSPATH') or die('No direct access allowed.');

$plugin = Plugins_Item::factory( array(
	'id' => 'page_not_found',
	'title' => 'Page not found',
	'description' => 'Provides Page not found type.'
) )->register();

if($plugin->enabled())
{	
	if(!IS_BACKEND)
	{
		// Observe
		Observer::observe('page_not_found', 'behavior_page_not_found');
	}
}

function behavior_page_not_found()
{
	$page = DB::select()
		->from(Model_Page::TABLE_NAME)
		->where('behavior_id', '=', 'page_not_found')
		->limit(1)
		->as_object()
		->execute()
		->current();

	if ($page)
	{
		$page = Model_Page_Front::find( $page->slug );

		// if we fund it, display it!
		if( is_object($page) )
		{
			echo Response::factory()
				->status(404)
				->body($page->render_layout());
			exit(); // need to exit here otherwise the true error page will be sended
		}
	}
}