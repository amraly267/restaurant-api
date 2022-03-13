<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $table = 'order_detail';
    public $fillable = ['order_id', 'meal_id', 'amount_to_pay'];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
