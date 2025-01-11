<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderState;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', arguments: Order::class);


        return view(
            'orders.index',
            data: [
                'orders' => Order::paginate(
                    config('pagination.default')
                )
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Order::class);
        $this->authorize('viewAny', User::class);
        $this->authorize('viewAny', OrderState::class);
        $orderstates= OrderState::query()->select([
            'order_states.id',
            'order_states.order_state_name',
        ])->get();
        $users= User::query()->select([
            'users.id',
            'users.name',
        ])->get();
        return view(
            'orders.form',
            [
                "users"=>$users,
                "orderstates"=>$orderstates
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
        //dd($order);

        $id =$order->id;

        $single_order= Order::query()
        ->join('users as workers', function ($users) {
            $users->on('orders.worker_id', '=', 'workers.id');
        })
        ->join('users as clients', function ($users) {
            $users->on('orders.client_id', '=', 'clients.id');
        })
          ->join('order_states', function ($order_states) {
            $order_states->on('orders.order_state_id', '=', 'order_states.id');
        })
        ->select([
        'orders.id',
        'orders.worker_id',
        'workers.name as worker_name',
        'clients.name as client_name',
        'order_states.order_state_name',
        'orders.price',
        'orders.deadline_of_completion',
        'orders.date_of_completion',
        'orders.description',

        ])->where('orders.id', '=', $id)->paginate(config('pagination.default'));

        //dd($single_order);

        $OrderProducts= OrderProduct::query()
        ->join('products', function ($products) {
            $products->on('order_products.product_id', '=', 'products.id');
        })
        ->select([
            'order_products.id',
            'order_products.order_id',
            'products.product_name',
            'order_products.price',
            'order_products.amount',
            'order_products.description',
        ])->where('order_products.order_id', '=', $id)->paginate(config('pagination.default'));

        //dd($OrderProducts);
        return view(
            'orders.show',
            [
                'OrderProducts'=>$OrderProducts,
                'single_order' =>$single_order,

            ]
        );


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $this->authorize('create', $order);
        $this->authorize('viewAny', User::class);
        $this->authorize('viewAny', OrderState::class);


        $users= User::query()->select([
            'users.id',
            'users.name',
        ])->get();

        $orderstates= OrderState::query()->select([
            'order_states.id',
            'order_states.order_state_name',
        ])->get();

        return view(
            'orders.form',
            [
                'order'=> $order,
                'users'=>$users,
                'orderstates'=>$orderstates,
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
