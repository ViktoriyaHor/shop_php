<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent()
    {
    	return $this->belongsTo(self::class, 'parent_id'); //получим 1 родителя
    }
    public function children()
    {
    	return $this->hasMany(self::class, 'parent_id'); //получим детей
    }
    //https://laravel.com/docs/5.8/eloquent-mutators#defining-a-mutator
    public function setSlugAttribute($value)
    {
    	if(!$value){
    		$this->attributes['slug'] = \Str::slug($this->attributes['name'], '-');
    	}
    	//https://laravel.com/docs/5.8/helpers#method-str-slug
    	else{
    		$this->attributes['slug'] = \Str::slug($value, '-');
    	}
    }
}
