<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['table_id', 'reservation_id', 'customer_id', 'waiter_id', 'total', 'paid'];

    public function detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
