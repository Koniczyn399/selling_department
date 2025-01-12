<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white-800 leading-tight">
            {{ __('translation.navigation.orderdetails') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                <div class="grid justify-items-stretch py-2">
                    @can('create', App\Models\Order::class)
                        <x-wireui-button primary label="{{ __('orders.actions.create') }}" href="{{ route('orders.create') }}"
                            class="justify-self-end" />
                    @endcan
                </div>

                <div class="py-12">

                

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                            <div class="container">
                                <div class="shadow-lg rounded-lg overflow-hidden mx-4">
                                    
                                
                                    {{ __('orders.attributes.order_id') }}: {{ $order->id }}<br>

                                    {{ __('orders.attributes.client_name') }}:
                                    @foreach ($single_order as $o)
                                        {{$o->client_name}}
                                        {{$o->client_last_name}}
                                    @endforeach
                                    <br>
                                    


                                    {{ __('orders.attributes.products') }}: 
                                    @foreach ($order->products as $product)
                                        {{$product->product_name}},
                                    @endforeach
                                    <br>

                                    
                                    {{ __('orders.attributes.joint_amount') }}: {{ $order->products->pluck('price')->sum() }}<br>

                                    {{ __('orders.attributes.seller_name') }}: 
                                    @foreach ($single_order as $o)
                                        {{$o->seller_name}}
                                        {{$o->seller_last_name}}
                                    @endforeach
                                    <br>

                                </div>
                                <div class="m-4">
                                  
                                </div>
                            </div>
                        </div>
                        @can('viewAny', App\Models\Order::class)
                            <x-wireui-button primary label="{{ __('orders.actions.show_orders_action') }}"
                                href="{{ route('orders.index') }}" class="justify-self-end" />
                        @endcan
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
