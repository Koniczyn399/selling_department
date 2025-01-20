<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.orderproducts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">

                @if (isset($orderproduct->id))
                    <livewire:order_products.order_product-form :orderproduct="$orderproduct" :new_id="$new_id" />
                @else
                    <livewire:order_products.order_product-form :new_id="$new_id"/>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
