
<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('orders.labels.edit_form_title') }}
            @else
                {{ __('orders.labels.create_form_title') }}
            @endif
        </h3>

    

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="id">{{ __('orders.attributes.order_id') }}:</label>
            </div>
            <div class="">
                <x-wireui-input disabled placeholder="{{ $id}}" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="date_of_order">{{ __('orders.attributes.date_of_order') }}:</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="date_of_order" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="client_name">{{ __('orders.attributes.client_name') }}:</label>
            </div>
            <select wire:model="client_id" id="client_id">
                <option value="" disabled selected>{{ __('orders.actions.choose_client') }}</option>
                @foreach ($users as $user)
                    @if($user->position == "")
                            <option value="{{ $user->id }}">{{ $user->name }} </option>
                    @endif
                @endforeach
            </select>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="seller_name">{{ __('orders.attributes.seller_name') }}</label>
            </div>
            <select wire:model="seller_id" id="seller_id">
                <option value="" disabled selected>{{ __('orders.actions.choose_seller') }}</option>
               
                @foreach ($users as $user)
                    @if($user->position != "")
                        <option value="{{ $user->id }}">{{ $user->name }} </option>
                    @endif
                @endforeach
            </select>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="product_id">{{ __('orderproducts.attributes.product_name') }}</label>
            </div>
            
            <select wire:model="product_id" id="product_id" multiple>
                <option value="" disabled selected>{{ __('orders.actions.choose_product') }}
                </option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </div>


        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('orders.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
