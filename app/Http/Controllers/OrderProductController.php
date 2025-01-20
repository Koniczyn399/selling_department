<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', arguments: OrderProduct::class);
        return view(
            'orderproducts.index',
            data: [
                'orderproducts' => OrderProduct::paginate(
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
        $this->authorize('create', OrderProduct::class);




        return view(
            'orderproducts.form',
            [
                "new_id"=>null,

            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderProduct $orderproduct)
    {
        $this->authorize('create', $orderproduct);
        $this->authorize('viewAny', Order::class);
        $this->authorize('viewAny', Product::class);

        $orders = Order::query()->join('users as clients', first: function ($users) {
            $users->on('orders.client_id', '=', 'clients.id');
        })->select([
            'orders.id',
            'clients.name as client_name',
        ])->get();

        $products = Product::query()->select([
            'products.id',
            'products.product_name',
        ])->get();

        return view(
            'orderproducts.form',
            [
                'orderproduct' => $orderproduct,
                'new_id'=>null,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderProductRequest $request, OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderProduct $orderProduct)
    {
        //$this->authorize('delete', $orderProduct);
    }

    public function anihilate(Request $request)
    {
        $this->authorize('delete', OrderProduct::class);
        $order_product_id = $request->order_product_id;
        $order_id = $request->order_id;
        $this->authorize('delete', OrderProduct::findOrFail($order_product_id));
        OrderProduct::findOrFail($order_product_id)->delete();
        $order=Order::findOrFail($order_id);
        return Redirect::route('orders.show', [$order]);

    }
}
