<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class DataController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_products=OrderProduct::query()
        ->join('products', function ($products) {
            $products->on('order_products.product_id', '=', 'products.id');
        })
        ->select('order_products.id', 'products.product_name')->get()->toArray();
        return $order_products;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $new_id=null)
    {
        $this->authorize('create', OrderProduct::class);

        //dd($id);


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
                "orders" => $orders,
                "products" => $products,
                "new_id" =>$new_id,

            ]
        );
    }

    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( )
    {

    }
}
