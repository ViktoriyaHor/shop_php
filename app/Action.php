<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $timestamps = false; // чтоб не было ошибок updated_at()
}
