<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Request;
use Validator;

use App\Meta;
use App\Post;

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
		$input = Request::all();

        // Validation.
        if($this -> validator($input) -> fails())
            return Redirect::to('blog/create')->withErrors( $this -> validator($input) )->withInput( $input );

        // Create a new record.
        $newPost = Post::create($input);

        // Success in saving : show new blog post.
        if(isset($newPost->id) && (int)$newPost -> id > 0)
        {
            // Store meta tags.
            $this -> storeMetas($input, $newPost->id);

            return Redirect::to("blog/$newPost->id")->with("success", "A new blog post was just created.");
        }

        // Problem saving.
        return Redirect::to("blog/create")->with("failure", "Problem saving the new blog post.")->withInput( $input );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::findOrFail($id);

        // Show the post.
        return view('posts.show',compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post = Post::findOrFail($id);

        return view('posts.edit',compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $input = Request::all();

        // Validation
        if($this -> validator($input) -> fails())
            return Redirect::to("blog/$id/edit")->withErrors( $this -> validator($input) )->withInput( $input );

        // Update an existing record.
        $isUpdated = Post::find($id)->update( $input );

        // Show the updated blog post or a failure message.
        if($isUpdated)
            return Redirect::to("blog/$id")->with("success", "The blog was successfully updated.");

        return Redirect::to("blog/$id")->with("failure", "Fail attempt in updating the blog post.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    private function validator($input)
    {
        // Validation rules
        $rules = array(
            'headline'     => 'required|min:10',// to do - need to be unique
            'body'         => 'required|min:20',
            'published_at' => 'required|date'
        );

        // Validate the inputs
        return Validator::make( $input, $rules );
    }

    private function storeMetas($input, $id)
    {
        // Check if the model exists.
        $m = Meta::where('post_id', '=', $id) -> first();

        if($m)
            return Meta::where('post_id', '=', $id)->update( $input );


        $input['post_id'] = $id;

        return Meta::create( $input );
    }
}
