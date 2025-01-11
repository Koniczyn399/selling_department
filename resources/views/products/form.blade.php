<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
              
                @if (isset($product->id)) 
                
                    <livewire:products.product-form :product="$product" :categories="$categories" :manufacturers="$manufacturers" />
                @else
                    <livewire:products.product-form :categories="$categories" :manufacturers="$manufacturers" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
