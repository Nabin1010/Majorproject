<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class Shippingaddress extends Model
{
    protected $fillable = ['state','city','area','address1','user_id','address2'];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
