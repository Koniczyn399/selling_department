<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderStateRequest;
use App\Http\Requests\UpdateOrderStateRequest;
use App\Models\OrderState;

class OrderStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', OrderState::class);
        return view(
            'orderstates.index',
            data: [
                'orderstates' => OrderState::paginate(
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
        $this->authorize('create', OrderState::class);

        return view(
            'orderstates.form'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderStateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderState $orderState)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderState $orderstate)
    {
        $this->authorize('update', $orderstate);

        return view(
            'orderstates.form',
            [
                'orderstate'=> $orderstate,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderStateRequest $request, OrderState $orderState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderState $orderstate)
    {
        $this->authorize('delete', $orderstate);
    }
}
