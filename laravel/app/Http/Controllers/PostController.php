<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Request;
use Validator;

use App\Meta;
use App\Post;
use App\Slug;
use App\Tag;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $posts = Post::all();

        return view('posts.index',compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = $this -> filterInput( Request::all() );

        // Validation.
        if($this -> validator( $input ) -> fails())
            return Redirect::to('blog/create') -> withErrors( $this -> validator( $input ) ) -> withInput( $input );

        // Create a new record.
        $newPost = Post::create( $input );

        // Success in saving : show new blog post.
        if(isset( $newPost->id ) && (int)$newPost -> id > 0)
        {
            $slug = $input['slug'];

            // Save slug.
            $slugObj = new Slug(['post_id' => $newPost -> id, 'slug' => $slug]);

            $newPost -> slug() -> save( $slugObj );


            return Redirect::to("blog/$slug")->with("success", "A new blog post was just created.");
        }

        // Problem saving.
        return Redirect::to("blog/create")->with("failure", "Problem saving the new blog post.")->withInput( $input );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
        $post = Slug::where('slug', $this -> filterSlug( $slug )) -> firstOrFail() -> post;

        return view('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function edit($slug)
    {
        $post = $this -> postBySlug( $this -> filterSlug( $slug ) );

        return view('posts.edit',compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function update($slug)
	{
        $slug  = $this -> filterSlug( $slug );

        $input = $this -> filterInput( Request::all() );

        // Validation
        if($this -> validator( $input ) -> fails())
            return Redirect::to("blog/$slug/edit")->withErrors( $this -> validator( $input ) )->withInput( $input );


        // Update the model.
        $post = $this -> postBySlug( $slug );

        $isUpdated = $this -> postBySlug( $slug ) -> update( $input );


        // Update related model.
        $post -> slug() -> update( ['slug' => Request::input('slug')] );

        // Consider the new slug, if created.
        $slug = Request::input('slug')?: $slug;


        // Show the updated blog post or a failure message.
        if($isUpdated)
            return Redirect::to("blog/$slug")->with("success", "The blog was successfully updated.");

        return Redirect::to("blog/$slug")->with("failure", "Fail attempt in updating the blog post.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($slug)
	{
		//
	}

    /**
     * @return \Illuminate\View\View
     */
    public function search()
    {
        $input = Request::all();

        $input["q"] = preg_replace('/[^A-Za-z0-9 \-\_]/','',Request::input('q'));

        $v = Validator::make( $input, ['q' => 'required|min:2'] );

        if($v->fails())
            return Redirect::to("/");

        $q = $input['q'];

        $posts = Post::where('headline', 'LIKE', "%$q%")->select(['id', 'headline'])->get();

        return view('search_results', compact('posts', 'q'));
    }

    /**
     * @param $input
     * @return mixed
     */
    private function validator( $input )
    {
        // Validation rules
        $rules = array(
            'headline'     => 'required|min:10',// to do - need to be unique
            'body'         => 'required|min:20',
            'published_at' => 'required|date',
            'slug'         => 'required'
        );

        // Validate the inputs
        return Validator::make( $input, $rules );
    }
/***
    private function storeMetas($input, $id)
    {
        // Check if the model exists.
        $m = Meta::where('post_id', '=', $id) -> first();

        if($m)
            return Meta::where('post_id', '=', $id)->update( $input );


        $input['post_id'] = $id;

        return Meta::create( $input );
    }
***/
    /**
     * @param $input
     * @return mixed
     */
    private function filterInput( $input )
    {
        $input['slug'] = $this -> filterSlug( $input['slug'] );

        return $input;
    }

    /**
     * @param $slug
     * @return mixed
     */
    private function filterSlug( $slug )
    {
        return preg_replace('/[^A-Za-z0-9\-\_]/', '', $slug);
    }

    /**
     * @param $slug
     * @return mixed
     */
    private function postBySlug( $slug )
    {
        return $post = Slug::where('slug', $slug) -> firstOrFail() -> post;
    }
}
