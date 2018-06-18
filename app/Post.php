<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['name', 'content', 'category_id'];

    public function category() 
    {
    	return $this->belongsTo('App\Category');
    }

    public function comments() 
    {
    	return $this->hasMany('App\Comment');
    }

    public function files() 
    {
        return $this->hasMany('App\File');
    }

    public function attachableComments() 
    {
        return $this->morphMany('App\Comment', 'attachable');
    }
}
