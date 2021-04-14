<?php

namespace App;

use App\Food;
use App\Subcategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['title'];


    public function foods()
        {
            return $this->hasMany(Food::class);
        }

}