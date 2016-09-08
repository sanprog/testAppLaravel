<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'text'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
  	}
}
