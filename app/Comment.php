<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['author', 'comment', 'attachable_id', 'attachable_type'];

    const TYPE_POST = 'App\Post';
	const TYPE_CATEGORY = 'App\Category';

    public function attachable() 
    {
    	return $this->morphTo();
    }
}
