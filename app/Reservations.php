<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    public $fillable = ['from_time', 'to_time', 'customer_id', 'table_id'];
}
