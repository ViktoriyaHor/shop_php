<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //прописываем связи
    public function category()
    {
    	return $this->belongsTo('App\Category');
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
//scope это подготовленные методы на вывод рекоммендуемы товаров
    public function scopeRecommended($query)//запрос попрадает в query
    {
        return $query->where('recommended', '=', 1);
    }
    public function scopeWithImg($query)
    {
        return $query->whereNotNull('img');
    }
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
