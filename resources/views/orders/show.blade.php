<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white-800 leading-tight">
            {{ __('translation.navigation.orderdetails') }}
        </h2>
    </x-slot>


                    <div class="content">
                    <div class="table_div">
                            <table>
                                <tr>
                                    <th class="left_table">{{ __('orders.attributes.order_id') }}: </th>
                                    <th class="right_table">{{ $order->id }}</th>
                                </tr>

                                            
                                @foreach ($single_order as $o)       
                                <tr>
                                    <th class="left_table"> {{ __('orders.attributes.employee') }}:</th>
                                    <th class="right_table">  {{$o->client_name}}  {{$o->client_last_name}}</th>
                                </tr>
                                @endforeach
                
                                    
                                <tr>
                                    <th class="left_table"> {{ __('orders.attributes.products') }}:</th>
                                    <th class="right_table"> 
                                    @foreach ($products as $product)
                                                    {{$product->product_name}}: {{$product->price}} zł x{{$product->order_products_amount}},
                                    @endforeach

                                    </th>
                                </tr>
                                <tr>
                                    <th class="left_table">{{ __('orders.attributes.joint_amount') }}:</th>
                                    <th class="right_table">  {{ $joint_amount }}</th>
                                </tr>
                                @foreach ($single_order as $o)       
                                <tr>
                                    <th class="left_table"> {{ __('orders.attributes.seller_name') }}:</th>
                                    <th class="right_table">  {{$o->seller_name}}   {{$o->seller_last_name}}</th>
                                </tr>
                                @endforeach
                            </table>
                        
                            </div>
                            <div class="button_divbox">
                              

                                <x-wireui-button primary label="{{ __('orders.actions.create') }}" href="{{ route('orders.create') }}"
                                class="justify-self-end" />

                                <x-wireui-button href="{{ route('orders.edit', [$single_order]) }}" secondary class="mr-2"
                                label="{{ __('translation.placeholder.edit') }}" />

                                <x-wireui-button href="{{ route('orders.index') }}" secondary class="mr-2"
                                label="{{ __('translation.placeholder.cancel') }}" />
                            </div>
                    </div>
    
</x-app-layout>
