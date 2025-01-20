<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.orderproducts') }}
        </h2>
    </x-slot>
    @if (isset($orderproduct->id))
        <livewire:order_products.order_product-form :orderproduct="$orderproduct" :new_id="$new_id" />
    @else
        <livewire:order_products.order_product-form :new_id="$new_id"/>
    @endif

</x-app-layout>
