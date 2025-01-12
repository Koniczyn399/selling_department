<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
              
                @if (isset($order->id)) 
                
                    <livewire:orders.order-form :order="$order" :users="$users" :products="$products" />
                @else
                    <livewire:orders.order-form :users="$users" :products="$products" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
