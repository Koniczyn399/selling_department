<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Order as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Order extends Model
{
    use HasApiTokens;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
                            "client_id",
                            "worker_id",
                            "order_state_id",
                            "date_of_completion",
                            "deadline_of_completion",
                            "price",
                            "description",
                        ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }


    public function order_states()
    {
        return $this->belongsTo(OrderState::class,'order_state_id');
    }

    public function orderproducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
