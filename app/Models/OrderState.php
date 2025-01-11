<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderState extends Model
{
    /** @use HasFactory<\Database\Factories\OrderStateFactory> */
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;
    protected $fillable = [
                            "order_state_name",
                        ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
