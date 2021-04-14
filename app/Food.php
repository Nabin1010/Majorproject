<?php

namespace App;

use App\Cart;
use App\Order;
use App\Category;
use App\Subcategory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table='foods';
    protected $fillable =['title','details','price','photo','cat_id','subcat_id'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
    
}
