<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.products') }}
        </h2>
    </x-slot>


              
                @if (isset($product->id)) 
                
                    <livewire:products.product-form :product="$product"  />
                @else
                    <livewire:products.product-form  />
                @endif

</x-app-layout>
