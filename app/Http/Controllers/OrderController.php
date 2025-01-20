<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderState;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', arguments: Order::class);

        $order= Order::query()
        ->where('orders.id', '=', 6)->first();


        return view(
            'orders.index',
            data: [
                'orders' => Order::paginate(
                    config('pagination.default')
                ),
                'order'=>$order,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Order::class);



        $products = Product::query()->select([
            'products.id',
            'products.product_name',
        ])->get();
        $users= User::query()->select([
            'users.id',
            'users.name',
        ])->get();
        return view(
            'orders.form',
            [
                "users"=>$users,
                "products"=>$products,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->authorize('show', $order);

      

    
        $single_order= Order::query()
        ->join('users as clients', function ($users) {
            $users->on('orders.client_id', '=', 'clients.id');
        })->join('users as sellers', function ($users) {
            $users->on('orders.seller_id', '=', 'sellers.id');
        })
          ->select([
            'orders.id',            
            'clients.name as client_name',
            'clients.last_name as client_last_name',

            'sellers.name as seller_name',
            'sellers.last_name as seller_last_name',

            'orders.date_of_order',
            'clients.position as position' ,

        ])->where('orders.id', '=', $order->id)->paginate(config('pagination.default'));


        // $joint_amount = OrderProduct::query()
        // ->join('products', function ($products) {
        //     $products->on('order_products.product_id', '=', 'products.id');
        // })
        // ->where("order_products.order_id","=", $order->id)
        // ->sum(DB::raw("order_products.amount * products.price"));

        $products = OrderProduct::query()
        ->join('products', function ($products) {
            $products->on('order_products.product_id', '=', 'products.id');
        })
        ->select([
            'order_products.order_id',
            'products.product_name',
            'products.price',
            'order_products.amount as order_products_amount',
            ])
        ->where("order_products.order_id","=", $order->id)->get();

        $joint_amount=0;
        foreach ($products as $product){
            $joint_amount+=$product->price * $product->order_products_amount;
        }


        return view(
            'orders.show',
            [
               
                'single_order' =>$single_order,
                'order' =>$order,
                'joint_amount'=>$joint_amount,
                'products'=>$products,

            ]
        );


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $this->authorize('create', $order);

        $users= User::query()->select([
            'users.id',
            'users.name',
            'users.last_name',
        ])->get();

        $products = Product::query()->select([
            'products.id',
            'products.product_name',
        ])->get();
        
        return view(
            'orders.form',
            [
                'order'=> $order,
                'users'=>$users,
                'products'=>$products,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->authorize('create', $order);
    }
}
