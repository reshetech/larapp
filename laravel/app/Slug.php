<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model {

	protected $fillable = ['slug', 'post_id'];

    public function post()
    {
        return $this -> belongsTo('App\Post');
    }
}
