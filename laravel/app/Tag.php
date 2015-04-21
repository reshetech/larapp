<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	public $fillable = ['name', 'description'];

    public $dates    = ['created_at'];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
