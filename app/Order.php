<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    public function status()
    {
    	return $this->belongsTo('App\Status');
    }

    public function getCreatedAtAttribute($value) // $value из бд получаем
    {
    	return Carbon::parse($value)->format('d.m.Y H:i'); //parse($value) преобразуем строку в время
    }
    public function items()
    {
    	return $this->hasMany('App\OrderItems');
    }
	
}
