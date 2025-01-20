<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.orderproducts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                <div class="grid justify-items-stretch py-2">
                    @can('create', App\Models\OrderProduct::class)
                        <x-wireui-button primary label="{{ __('orderproducts.actions.create') }}"
                            href="{{ route('orderproducts.create',['id'=>null]) }}" class="justify-self-end" />
                    @endcan
                </div>
                <livewire:order-products.order-product-table />
            </div> 
        </div>
    </div>
</x-app-layout>
