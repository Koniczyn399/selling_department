<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{


    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
                            "category_name",
                        ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }


}
