<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table = 'posts';

    protected $dates = ['published_at'];

    protected $fillable = ['headline','body','published_at'];

}
