<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
                            "category_id",
                            "manufacturer_id",
                            "product_name",
                            "price",
                            "unit",
                            "amount",
                            "description",
                        ];

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function manufacturers()
    {
        return $this->belongsTo(Manufacturer::class,'manufacturer_id');
    }

    public function orderproducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
