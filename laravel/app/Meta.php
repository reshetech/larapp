<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model {

    protected $table    = 'metas';

    protected $fillable = ['title', 'description', 'twitter_card', 'og_title', 'og_image', 'og_description', 'post_id'];

    public function post()
    {
        return $this -> belongsTo('App\Post');
    }
}
