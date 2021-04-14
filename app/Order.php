<?php

namespace App;

use App\Cart;
use App\Food;
use App\User;
use App\Shippingaddress;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['address','phonenumber' ,'payment_method','user_id','food_id','status','price','payment_status'];

    // 
    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('quantity');;
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function shippingaddress()
    {
        return $this->belongsTo(Shippingaddress::class);
    }
    public $timestamps = true;
}
