<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Request;
use Validator;

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

        // Validation rules
        $rules = array(
            'headline'     => 'required|unique:posts,headline|min:10',
            'body'         => 'required|min:20',
            'published_at' => 'required|date'
        );

        // Validate the inputs
        $v = Validator::make( $input, $rules );

        // Was the validation successful?
        if ( $v->fails() )
        {
            // Something went wrong
            return Redirect::to('posts.create')->withErrors( $v )->withInput( $input );
        }

        // Create a new record.
        $newPost = Post::create($input);

        // Show the newly created post.
        return Redirect::to("blog/$newPost->id");
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

}
