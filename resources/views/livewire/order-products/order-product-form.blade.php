<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('orderproducts.labels.edit_form_title') }}
            @else
                {{ __('orderproducts.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="order_id">{{ __('orderproducts.attributes.order_id') }}</label>
            </div>
            @if($order_created)
                <select wire:model="order_id" id="order_id" disabled="true">
            @else
                <select wire:model="order_id" id="order_id">
            @endif
                <option value="" disabled selected>{{ __('orders.actions.choose_order') }}</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}: {{ $order->client_name }} {{ $order->client_last_name }}</option>
                @endforeach
            </select>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="product_id">{{ __('orderproducts.attributes.product_name') }}</label>
            </div>
            <select wire:model="product_id" id="product_id">
                <option value="" disabled selected>{{ __('orderproducts.actions.choose_product') }}
                </option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}: {{ $product->price }} zł</option>
                @endforeach
            </select>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="amount">{{ __('orderproducts.attributes.amount') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="amount" />
            </div>
        </div>


        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('orderproducts.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
