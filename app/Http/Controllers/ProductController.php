<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Manufacturer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', arguments: Product::class);
        return view(
            'products.index',
            data: [
                'products' => Product::paginate(
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
        $this->authorize('create', Product::class);
        $this->authorize('viewAny', Category::class);
        $this->authorize('viewAny', Manufacturer::class);

        $categories= Category::query()->select([
            'categories.id',
            'categories.category_name',
        ])->get();

        $manufacturers= Manufacturer::query()->select([
            'manufacturers.id',
            'manufacturers.manufacturer_name',
        ])->get();

        return view(
            'products.form',
            [
                'categories'=>$categories,
                'manufacturers'=>$manufacturers,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('create', Product::class);
        $this->authorize('viewAny', Category::class);
        $this->authorize('viewAny', Manufacturer::class);

        $categories= Category::query()->select([
            'categories.id',
            'categories.category_name',
        ])->get();

        $manufacturers= Manufacturer::query()->select([
            'manufacturers.id',
            'manufacturers.manufacturer_name',
        ])->get();

        return view(
            'products.form',
            [
                'product'=> $product,
                'categories'=>$categories,
                'manufacturers'=>$manufacturers,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
    }
}
