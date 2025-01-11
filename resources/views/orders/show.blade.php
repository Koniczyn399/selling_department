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

                    @foreach ($single_order as $order)
                        {{ __('orders.attributes.order_id') }}: {{ $that_order_id=$order->id }} <br>
                        {{ __('orders.attributes.client_name') }}: {{ $order->worker_name }}<br>
                        {{ __('orders.attributes.worker_name') }}: {{ $order->client_name }}<br>
                        {{ __('orders.attributes.order_state_name') }}: {{ $order->order_state_name }}<br>
                        {{ __('orders.attributes.price') }}: {{ $order->price }}<br>
                        {{ __('orders.attributes.deadline_of_completion') }}: {{ $order->deadline_of_completion }}<br>
                        {{ __('orders.attributes.date_of_completion') }}: {{ $order->date_of_completion }}<br>
                        {{ __('orders.attributes.description') }}: {{ $order->description }}<br>
                       
                    @endforeach

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                            <div class="container">
                                <div class="shadow-lg rounded-lg overflow-hidden mx-4">
                                    <table class="w-full table-fixed">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">
                                                    {{ __('orderproducts.attributes.order_product_id') }}
                                                </th>
                                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">
                                                    {{ __('orderproducts.attributes.order_id') }}
                                                </th>
                                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">
                                                    {{ __('orderproducts.attributes.product_name') }}
                                                </th>
                                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">
                                                    {{ __('orderproducts.attributes.amount') }}
                                                </th>
                                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">
                                                    {{ __('orderproducts.attributes.price') }}
                                                </th>
                                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">
                                                    {{ __('orderproducts.attributes.description') }}
                                                </th>
                                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">
                                                    {{ __('orderproducts.actions.actions') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($OrderProducts as $OrderProduct)
                                                <tr>
                                                    <td class="py-4 px-6 border-b border-gray-200">
                                                        {{ $OrderProduct->id }}
                                                    </td>
                                                    <td class="py-4 px-6 border-b border-gray-200 truncate">
                                                        {{ $OrderProduct->order_id }}
                                                    </td>
                                                    <td class="py-4 px-6 border-b border-gray-200">
                                                        {{ $OrderProduct->product_name }}
                                                    </td>
                                                    <td class="py-4 px-6 border-b border-gray-200">
                                                        {{ $OrderProduct->amount }}
                                                    </td>
                                                    <td class="py-4 px-6 border-b border-gray-200">
                                                        {{ $OrderProduct->price }}
                                                    </td>
                                                    <td class="py-4 px-6 border-b border-gray-200">
                                                        {{ $OrderProduct->description }}
                                                    </td>
                                                    <td class="py-4 px-6 border-b border-gray-200">
                                                        <x-wireui-button primary
                                                        label="{{ __('orderproducts.actions.edit_orderproduct_action') }}"
                                                        href="{{ route('orderproducts.edit', [$OrderProduct]) }}"
                                                        class="justify-self-end" />
                                                        
                                                        <form action="{{route('orderproducts.anihilate')}}" method="get">
                                                            {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <input type="text" hidden="hidden" name='order_product_id' value='{{$OrderProduct->id}}'/>
                                                                <input type="text" hidden="hidden" name='order_id' value='{{$that_order_id}}' />
                                                            </div>
                                                                <x-wireui-button type="submit" primary label="{{ __('orderproducts.actions.remove_orderproduct_action')}}" spinner />
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="m-4">
                                    {{-- <!--{{ $OrderProducts->links() }} -->
                                    {{ $OrderProducts->links() }} --}}
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
