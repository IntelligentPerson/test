<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'description'];

    public function posts() 
    {
    	return $this->hasMany('App\Post');
    }

    public function comments() 
    {
    	return $this->hasMany('App\Comment');
    }

    public function attachableComments() 
    {
    	return $this->morphMany('App\Comment', 'attachable');
    }
}
