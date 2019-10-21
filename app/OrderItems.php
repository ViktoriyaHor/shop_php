<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    public $timestamps = false; // чтоб не было ошибок updated_at()
}
