<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Meta;

use View;

class MetaServiceProvider extends ServiceProvider {

     public $defaultMeta = [
         'title'          => 'default title',
         'description'    => '',
         'twitter_card'   => '',
         'og_title'       => '',
         'og_image'       => '',
         'og_description' => ''
     ];


	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

        View::composer('partials.meta', function($view) {
            $meta = null;


            if($view->post)
            {
                $postId = $view->post->id;

                $meta = Meta::where('post_id', '=', $postId)->first();
            }

            if(!$meta)
            {
                $meta = json_decode(json_encode($this->defaultMeta), FALSE);
            }

            $view->with('meta', $meta );
        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
