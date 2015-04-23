<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table    = 'posts';

    protected $dates    = ['published_at'];

    protected $fillable = ['headline','body','published_at','user_id'];

    public function meta()
    {
        return $this -> hasOne('App\Meta');
    }

    public function slug()
    {
        return $this -> hasOne('App\Slug');
    }

    public function tag()
    {
        return $this -> hasOne('App\Tag');
    }

    public function user()
    {
        return $this -> belongsTo('App\User');
    }
}
