<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

use Illuminate\Routing\Route;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
       
       
        $this->authorize('viewAny', User::class);
        
     
            return view(
                'users.index',
                [
                    'users' => User::paginate(
                        config('pagination.default')
                    )
            
                ]
            );

    }


    public function create()
    {
        //$this->authorize('create', User::class);
        return view(
            'users.form'
        );
    }


    public function edit(User $user)
    {
        //$this->authorize('update', $user);

        return view(
            'users.form',
            [
                'user'=> $user,
            ]
        );
    }

    public function show(User $user, ?string $history =null)
    {
        //$this->authorize('update', $user);
        $orders= Order::query()
        ->where('orders.client_id', '=', $user->id)->get();
        $orders_var= Order::query()->select('orders.id')
            ->where('orders.client_id', '=', $user->id)->get()->toArray();
        $order_products=null;
        if($history=='true'){

            $order_products= OrderProduct::query()
            ->join('products', function ($users) {
                $users->on('products.id', '=', 'order_products.product_id');
            })
            ->whereIn('order_products.order_id',$orders_var)->get();  
        }

        return view(
            'users.show',
            [
                'user'=> $user,
                'orders'=>$orders,
                'order_products' => $order_products,
                'var'=>0,

            ]
        );
    }


}
