<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('products.labels.edit_form_title') }}
            @else
                {{ __('products.labels.create_form_title') }}
            @endif
        </h3>

      

        @if (isset($id))
            {{__('products.attributes.product_id')}}: {{ $product->id}}   
        @endif

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
      
            <div class="">
                <label for="product_name">{{ __('products.attributes.product_name') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="product_name" />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="unit">{{ __('products.attributes.unit') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="unit" />
            </div>
        </div>

        
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="price">{{ __('products.attributes.price') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="price" />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">{{ __('products.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('products.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
