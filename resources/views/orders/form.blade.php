<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.orders') }}
        </h2>
    </x-slot>

    
              
    @if (isset($order->id)) 
        <livewire:orders.order-form :order="$order" :users="$users" :products="$products" />
    @else
        <livewire:orders.order-form :users="$users" :products="$products" />
    @endif

</x-app-layout>
